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
                <h1>商品情報 編集画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
                try 
                {
                    $pro_code=$_GET['procode'];
            
            $dsn='mysql:host=mysql;dbname=ASWD_shop';
            $user='ad03';
            $password='Pw12345@user-A';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->query('SET NAMES utf8');
            
                    $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
                    $stmt=$dbh->prepare($sql);
                    $data[]=$pro_code;
                    $stmt->execute($data);
            
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    $pro_name=$rec['name'];
                    $pro_price=$rec['price'];
                    $pro_gazou_name_old=$rec['gazou'];
            
                    $dbh=null;
            
                    if($pro_gazou_name_old=='')
                    {
                        $disp_gazou='';
                    }
                    else
                    {
                        $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
                    }
                }
                catch(Exception $e)
                {
                    echo 'データを取得できませんでした。<br/>';
                    echo 'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }
            
            ?>
            
            <h2>商品修正</h2>
            <form class="form_contact" method="post" action="./pro_edit_check.php" enctype="multipart/form-data">
              <input class="dta_select" type="hidden" name="code" value="<?php echo $pro_code; ?>">
              <input class="dta_select" type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old; ?>">
              <table class="table_contact-form">
                <tr class="tr_cttfm">
                  <th class="th_cttfm">商品コード </th>
                  <td class="td_cttfm"> <?php echo $pro_code; ?></td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="name">Name </label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_input" type="text" name="name" value="<?php echo $pro_name; ?>">
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="name">Price </label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_select" type="text" name="price" value="<?php echo $pro_price; ?>">円
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="name">Image </label>
                  </th>
                  <td class="td_cttfm"><?php echo $disp_gazou; ?></td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="name">New Image </label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_select" type="file" name="gazou">
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_select" type="button" onclick="history.back()" value="戻る">
                    <input class="dta_select" type="submit" value="OK">
                  </td>
                </tr>
              </table>
            </form>
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