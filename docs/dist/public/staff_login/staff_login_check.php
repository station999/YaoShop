<?php
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サイト名：八百八</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">  
    <link rel="stylesheet" href="C:/P/station/YaoShop/docs/dist/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
  </head>
  <body>
    <div class="site ly_site">
      <header class="st_header">
        <div class="ly_hdr_inner">
          <div class="el_top-logo">
            <a href="http://localhost:8000"> 
              <img class="img_plncd frm_pln_img" src="C:/P/station/YaoShop/docs/dist/images/common/logo/logo.png" style="height: 50px;" alt="Home Logo">
            </a>
          </div>
          <input class="hmbg-btn" type="checkbox" id="hmbg-btn">
          <label class="hmbg-icon" for="hmbg-btn">
            <span class="hmbg-icon_parts"></span>
          </label>
          <nav class="nav_global el_hdr_nav">
            <ul class="ul_glbnv">
              <li class="li_glbnv"> <a href="http://localhost:8000">Home</a></li>
              <li class="li_glbnv"> <a href="###">情報</a></li>
              <li class="li_glbnv"> <a href="###">商品</a></li>
              <li class="li_glbnv"> <a href="###">注文</a></li>
              <li class="li_glbnv"> <a href="###">登録</a></li>
              <li class="li_glbnv"> <a href="http://localhost:8000/staff">スタッフ</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="st_container lyst_main">
        <main>
          <section class="section__odd">
            <div class="cpnt_title__border">
              <div class="inner_ttlbd__hrzn">
                <h1>スタッフログイン チェック画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
                //- ob_start();
                //- session_start();
                // try
                // {
                    require_once('../common/functions/sanitize.php');
            
                    $post=sanitize($_POST);
                    $staff_code=$post['code'];
                    $staff_pass=$post['pass'];
            
                    // DB connect 
                    $dsn='mysql:host=mysql;dbname=yao_shop;charset=utf8';
                    $user='ad03';
                    $password='Pw12345@user-A';
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ];
                    $dbh=new PDO($dsn,$user,$password,$options);
                        
                    $sql='SELECT name,password FROM mst_staff WHERE code=?';
                    $stmt=$dbh->prepare($sql);
                    $data[]=$staff_code;
                    $stmt->execute($data);
            
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            
                    $dbh=null;
            
                    if($rec && password_verify($staff_pass, $rec['password'])) 
                    {
                        session_start();
                        $_SESSION['login'] = 1; 
                        $_SESSION['staff_code'] = $staff_code; 
                        $_SESSION['staff_name'] = $rec['name']; 
                        header('Location: staff_top.php');
                        exit();
                    }
                    else 
                    {
                        echo 'スタッフコードかパスワードが間違っています。<br/>';
                        echo '<a href="staff_login.php">戻る</a>';
                    }      
                // }
                // catch(Exception $e)
                // {
                //     echo '通信障害のため確認できませんでした。<br/>';
                //     echo '大変ご迷惑をおかけしております。';
                //     exit();
                // }
                //- ob_end_flush();
            ?>
          </section>
        </main>
      </div>
      <footer class="st_footer lyst_ftr">
        <hr class="hr_footer-line"><small class="small_copy">&copy;2000 AWD Shop</small>
        <hr class="hr_footer-line">
      </footer>
      
      <script src="C:/P/station/YaoShop/docs/dist/js/base.js" charset="utf-8"></script>
      
    </div>
  </body>
</html>