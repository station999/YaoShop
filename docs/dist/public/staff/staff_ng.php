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
    <title>八百八：NG </title>
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
          <sectioncontainer class="text-bg-success p-4">
            <div class="cpnt_title__border">
              <div class="inner_ttlbd__hrzn">
                <h1>NG 画面</h1>
              </div>
            </div>
          </sectioncontainer>
          <section class="section__even">
            <p>スタッフが選択されていません。</p>
            <button class="btn btn-warning my-3" type="button"><a href="./staff_list.php">戻る</a></button>
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