<!-- 
  <?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login'])==false)
    {
    echo 'ようこそゲスト様';
    echo '<a href="member_login.php">会員ログイン</a><br/>';
    echo '<br/>';
    }
    else
    {
    echo '<br/>';
    echo '<section class="section__even">';
    echo 'ようこそ';
    echo $_SESSION['member_name'];
    echo '様<br/>';
    echo '<a href="member_logout.php">ログアウト</a><br/>';
    echo '</section">';
    }
  ?>
-->
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
                <h1>お客様情報 登録画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
            
                require_once('../common/functions/sanitize.php');
            
                $post=sanitize($_POST);
            
                $onamae=$post['onamae'];
                $email=$post['email'];
                $postal=$post['postal'];
                $address=$post['address'];
                $tel=$post['tel'];
            
                $errors = [];
            
                if($onamae=='')
                {
                    $errors[] ='適切なお名前が入力されていません。<br/>';
                }
                else 
                {
                    echo 'お名前：';
                    echo htmlspecialchars($onamae, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
                //- if (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) 
                if (preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$email)==0) 
                {
                    $errors[] = '適切なメールアドレスが入力されていません。<br/>';
                } 
                else 
                {
                    echo 'メールアドレス：';
                    echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
                if (preg_match('/^\d{3}-\d{4}$/', $postal) == 0) 
                {
                    $errors[] = '適切な郵便番号が入力されていません。半角数字で入力して下さい。<br/>';
                } 
                else 
                {
                    echo '郵便番号：';
                    echo htmlspecialchars($postal, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
                if($address=='')
                {
                    $errors[] ='住所が入力されていません。<br/>';
                }
                else 
                {
                    echo '住所：';
                    echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
                }
                if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0) 
                {
                    $errors[] = '適切な電話番号が入力されていません。半角数字で入力して下さい。<br/>';
                } 
                else 
                {
                    echo '電話番号：';
                    echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8');
                    echo '<br/>';
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
                    echo '<form method="post" action="./shop_form_done.php" class="form_contact">';
                    echo '<input type="hidden" name="onamae" value="' . htmlspecialchars($onamae, ENT_QUOTES, 'UTF-8') . '">';
                    echo '<input type="hidden" name="email" value="' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '">';
                    echo '<input type="hidden" name="postal" value="' . htmlspecialchars($postal, ENT_QUOTES, 'UTF-8') . '">';
                    echo '<input type="hidden" name="address" value="' . htmlspecialchars($address, ENT_QUOTES, 'UTF-8') . '">';
                    echo '<input type="hidden" name="tel" value="' . htmlspecialchars($tel, ENT_QUOTES, 'UTF-8') . '">';
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