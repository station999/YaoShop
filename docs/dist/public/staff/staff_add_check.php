<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
    echo 'ログインされていません。<br/>';
    echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">  
    <link rel="stylesheet" href="C:/P/station/YaoShop/docs/dist/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>八百八：スタッフ登録</title>
  </head>
  <body class="text-bg-secondary">
    <div class="container text-bg-light p-3">
      <header class="st_header">
        <nav class="row d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom bg-warning bg-body-secondary">
          <div class="col-12 col-md-1 mb-2 mb-md-0"><a class="d-inline-flex link-body-emphasis text-decoration-none" href="http://localhost:8000"><img class="d-inline-block align-text-top" src="C:/P/station/YaoShop/docs/dist/images/common/logo/logo.png" alt="Logo" width="40" height="32"></a></div>
          <ul class="nav col-12 col-md-6 mb-2 justify-content-center mb-md-0">
            <li class="nav-item px-2"> <a class="nav-link" href="http://localhost:8000">Home</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="http://localhost:8000/product/pro_list.php">商品一覧</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="http://localhost:8000/shop/shop_list.php">注文ページ</a></li>
          </ul>
          <div class="col-12 col-md-5 text-end">
            <button class="btn btn-outline-primary me-2" type="button">Login<a class="nav-link" href="http://localhost:8000/member/member_top.php">お客様 ログイン</a></button>
            <button class="btn btn-outline-primary me-2" type="button">Login<a class="nav-link" href="http://localhost:8000/staff_login/staff_top.php">スタッフ ログイン</a></button>
            <button class="btn btn-primary" type="button">Sign-up</button>
          </div>
        </nav>
      </header>
      <div class="st_main">
        <main>
          <section class="container text-bg-success p-4">
            <div class="cpnt_title__border">
              <div class="inner_ttlbd__hrzn">
                <h1>スタッフ 入力データ確認画面</h1>
              </div>
            </div>
          </section>
          <section class="container p-4">
            <?php
            
                require_once('../common/functions/sanitize.php');
            
                $post=sanitize($_POST);
                
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
                    echo '<form method="post" action="./staff_add_done.php" class="bg-primary-subtle p-4 mt-4">';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="name">';
                    echo 'スタッフ名：';
                    echo '</label>';
                    echo '<input class="form-control" type="text" placeholder="';
                    echo htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
                    echo '" aria-label="Disabled input example" disabled readonly>';
                    echo '</div>';
                }
            
                if(!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) 
                {
                    $errors[] = '適切なメールアドレスが入力されていません。<br/>';
                } 
                else 
                {
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="Email">';
                    echo 'メールアドレス：';
                    echo '</label>';
                    echo '<input class="form-control" type="text" placeholder="';
                    echo htmlspecialchars($staff_email, ENT_QUOTES, 'UTF-8');
                    echo '" aria-label="Disabled input example" disabled readonly>';
                    echo '</div>';
                }
            
                if($staff_pass=='')
                {
                    $errors[] = '適切なパスワードが入力されていません。<br/>';
                }
                if($staff_pass!=$staff_pass2)
                {
                    $errors[] = 'パスワードが一致しません。<br/>';
                }
            
                if(!empty($errors))
                {
                    foreach ($errors as $error) 
                    {
                        echo $error;
                    }
                    echo '<form method="post" action="./staff_add_done.php" class="bg-primary-subtle p-4 mt-4">';
                    echo '<button type="button" onclick="history.back()" class="btn btn-secondary">Buck</button>';
                    echo '</form>';
                }
                else 
                {
                    $staff_pass=password_hash($staff_pass, PASSWORD_DEFAULT);
                    echo '<form method="post" action="./staff_add_done.php" class="p-4 mt-4">';
                    echo '<input type="hidden" name="name" value="' . htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8') . '" class="dta_input">';
                    echo '<input type="hidden" name="email" value="' . htmlspecialchars($staff_email, ENT_QUOTES, 'UTF-8') . '" class="dta_input">';
                    echo '<input type="hidden" name="pass" value="' . $staff_pass . '" class="dta_input">';
                    echo '<br/>';
                    echo '<div class="mb-3">';
                    echo '<button type="submit" class="btn btn-primary">Submit</button>';
                    echo '<button type="button" onclick="history.back()" class="btn btn-secondary" >Buck</button>';
                    echo '</form>';
                }
            
            ?>
          </section>
        </main>
      </div>
      <footer class="st_footer footer">
        <div class="container text-bg-dark p-1">
          <hr class="hr_footer-line">
          <div class="row mx-auto text-white">
            <div class="text-center"><small class="small_copy">&copy;2000 AWD Shop</small></div>
          </div>
          <hr class="hr_footer-line">
        </div>
      </footer>
      
      <script src="C:/P/station/YaoShop/docs/dist/js/base.js" charset="utf-8"></script>
      
    </div>
  </body>
</html>