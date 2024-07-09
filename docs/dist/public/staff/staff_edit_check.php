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
                <h1>スタッフデータ修正 確認画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
            
                require_once('../common/functions/sanitize.php');
            
                $post=sanitize($_POST);
                $staff_code=$post['code'];
                $staff_name=$post['name'];
                $staff_email=$post['email'];
                $staff_pass=$post['pass'];
                $staff_pass2=$post['pass2'];
            
                $errors = [];
            
                if($staff_name=='')
                {
                    $errors[] ='適切なスタッフ名が入力されていません。<br/>';
                }
                else 
                {
                    echo 'スタッフ名：';
                    echo htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
            
                if (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = '適切なメールアドレスが入力されていません。<br/>';
                } else {
                    echo 'メールアドレス：';
                    echo htmlspecialchars($staff_email, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
            
                if($staff_pass=='')
                {
                    echo '適切なパスワードが入力されていません。<br/>';
                }
                if($staff_pass!=$staff_pass2)
                {
                    echo 'パスワードが一致しません。<br/>';
                }
            
                if(!empty($errors))
                {
                    foreach ($errors as $error) 
                    {
                        echo $error;
                    }
                    echo '<form class="form_contact">';
                    echo '<input type="button" onclick="history.back()" value="戻る" class="dta_select">';
                    echo '</form>';
                }
                else 
                {
                    $staff_pass=password_hash($staff_pass, PASSWORD_DEFAULT);
                    echo '<form method="post" action="./staff_edit_done.php" class="form_contact">';
                    echo '<input type="hidden" name="code" value="'. $staff_code .'" class="dta_select">';
                    echo '<input type="hidden" name="name" value="' . htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8') . '" class="dta_input">';
                    echo '<input type="hidden" name="email" value="' . htmlspecialchars($staff_email, ENT_QUOTES, 'UTF-8') . '" class="dta_input">';
                    echo '<input type="hidden" name="pass" value="'. $staff_pass .'" class="dta_input">';
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