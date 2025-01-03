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
                <h1>商品修正 確認確認</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
            
                require_once('../common/functions/sanitize.php');
            
                $post=sanitize($_POST);
                $pro_code=$post['code'];
                $pro_name=$post['name'];
                $pro_price=$post['price'];
                $pro_gazou_name_old=$post['gazou_name_old'];
                $pro_gazou=$_FILES['gazou'];
                
            
                if($pro_name=='')
                {
                    echo'適切な商品名が入力されていません。<br/>';
                }
                else 
                {
                    echo '商品名：';
                    echo $pro_name;
                    echo '<br/>';
                }
            
                if(preg_match('/^[0-9]+$/',$pro_price)==0)
                {
                    echo '適切な価格が入力されていません。<br/>';
                }
                else 
                {
                    echo '価格：';
                    echo $pro_price;
                    echo '円<br/>';
                }
            
                // if($pro_gazou['size']>0)
                if(isset($_FILES['gazou']) && $pro_gazou['size']>0)
                {
                    if($pro_gazou['size']>1000000)
                    {
                        echo '画像サイズが大き過ぎます';
                    }
                    else
                    {
                        move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
                        echo '<img src="./gazou/'.$pro_gazou['name'].'">';
                        echo '<br/>';
                    }
                }
            
                if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0 || $pro_gazou['size']>1000000)
                {
                    echo '<form class="form_contact">';
                    echo '<input type="button" onclick="history.back()" value="戻る" class="dta_select">';
                    echo '</form>';
                }
                else 
                {
                    echo '上記のように変更します。<br/>';
                    echo '<form method="post" action="./pro_edit_done.php" class="form_contact">';
                    echo '<input type="hidden" name="code" value="' . $pro_code . '" class="dta_input">';
                    echo '<input type="hidden" name="name" value="' . $pro_name . '" class="dta_input">';
                    echo '<input type="hidden" name="price" value="' . $pro_price . '" class="dta_input">';
                    echo '<input type="hidden" name="gazou_name_old" value="' . $pro_gazou_name_old . '" class="dta_input">';
                    echo '<input type="hidden" name="gazou_name" value="' . $pro_gazou['name'] . '" class="dta_input">';
                    echo '<br/>';
                    echo '<input type="button" onclick="history.back()" value="戻る" class="dta_select">';
                    echo '<input type="submit"  value="登録" class="dta_select">';
                    echo '</form>';
                }
            
            ?>
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