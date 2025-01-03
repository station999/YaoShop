<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
    echo 'ログインされていません。<br/>';
    echo '<a href="./staff_login.php">ログイン画面へ</a>';
    exit();
    }
    else
    {
    echo '<br/>';
    echo '<section class="section__even">';
    echo $_SESSION['staff_name'];
    echo 'さんログイン中<br/>';
    echo '</section">';
    }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サイト名</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">  
    <link rel="stylesheet" href="./../../../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
  </head>
  <body>
    <div class="site ly_site">
      <header class="st_header">
        <div class="ly_hdr_inner">
          <div class="el_top-logo"><a href="#{siteDomain}"> <img class="img_plncd frm_pln_img" src="#{workDirPath}assetsimagescommonlogologo.png" style="height: 50px;" alt="Home Logo"></a></div>
          <input class="hmbg-btn" type="checkbox" id="hmbg-btn">
          <label class="hmbg-icon" for="hmbg-btn"><span class="hmbg-icon_parts"></span></label>
          <nav class="nav_global el_hdr_nav">
            <ul class="ul_glbnv">
              <li class="li_glbnv"> <a href="#{siteDomain}">Home</a></li>
              <li class="li_glbnv"> <a href="###">情報</a></li>
              <li class="li_glbnv"> <a href="###">商品</a></li>
              <li class="li_glbnv"> <a href="###">注文</a></li>
              <li class="li_glbnv"> <a href="###">登録</a></li>
              <li class="li_glbnv"> <a href="#{siteDomain}/staff">スタッフ</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="st_container lyst_main">
        <main>
          <section class="section__odd">
            <div class="cpnt_title__border">
              <div class="inner_ttlbd__hrzn">
                <h1>登録結果</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
                try 
                {
                    require_once('../common/functions/sanitize.php');
            
                    $post=sanitize($_POST);
                    $pro_code=$post['code'];
                    $pro_name=$post['name'];
                    $pro_price=$post['price'];
                    $pro_gazou_name_old=$_POST['gazou_name_old'];
                    $pro_gazou_name=$_POST['gazou_name'];
            
            
            $dsn='mysql:host=mysql;dbname=ASWD_shop';
            $user='ad03';
            $password='Pw12345@user-A';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->query('SET NAMES utf8');
            
                    $sql='UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
                    $stmt=$dbh->prepare($sql);
                    $data[]=$pro_name;
                    $data[]=$pro_price;
                    $data[]=$pro_gazou_name;
                    $data[]=$pro_code;
                    $stmt->execute($data);
            
                    $dbh=null;
            
                    if($pro_gazou_name_old!=$pro_gazou_name)
                    {
                        if($pro_gazou_name_old!='')
                        {
                            unlink('./gazou/'.$pro_gazou_name_old);
                        }
                    }
            
                    echo $pro_name;
                    echo 'を修正しました。<br/>';
                }
                catch(Exception $e)
                {
                    echo $pro_name;
                    echo 'を登録できませんでした。<br/>';
                    echo 'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }
            
            ?>
            
            <div class="form_contact"><a class="dta_select" href="./pro_list.php">戻る</a></div>
          </section>
        </main>
      </div>
      <footer class="st_footer lyst_ftr">
        <hr class="hr_footer-line"><small class="small_copy">&copy;2000 AWD Shop</small>
        <hr class="hr_footer-line">
      </footer>
      
      <script src="https://example.com/assets/js/base.js" charset="utf-8"></script>
      <script src="https://example.com/assets/js/cnpt_table.js" charset="utf-8"></script>
      
    </div>
  </body>
</html>