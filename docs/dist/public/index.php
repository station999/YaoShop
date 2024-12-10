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
    <title>八百八：Home</title>
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
                <h1>全ファイル表示</h1>
              </div>
            </div>
          </section>
          <section class="container p-4">
            <p class="mt-4 fw-bold text-decoration-underline">ORDER</p>
            <ul class="list-group list-group-horizontal p-4 mt-2">
              <li class="list-group-item"><a href="./../order/order_download_done.php">注文データ ダウンロード 実行</a></li>
              <li class="list-group-item"><a href="./../order/order_download.php">注文データ ダウンロード</a></li>
            </ul>
            <p class="mt-4 fw-bold text-decoration-underline">PRODUCT</p>
            <ul class="list-group list-group-flush p-4 mt-2">
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./../product/pro_add_check.php">商品 追加 チェック</a></li>
                  <li class="list-group-item"><a class="ml-2" href="./../product/pro_add_done.php">商品 追加 実行</a></li>
                  <li class="list-group-item"><a class="ml-2" href="./../product/pro_add.php">商品 追加</a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./../product/pro_branch.php">商品 枝</a></li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./../product/pro_delete_done.php">商品 削除 実行</a></li>
                  <li class="list-group-item"><a href="./../product/pro_delete.php">商品 削除</a></li>
                </ul>
              </li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./../product/pro_edit_check.php">商品 編集 チェック</a></li>
                  <li class="list-group-item"><a href="./../product/pro_edit_done.php">商品 編集 実行</a></li>
                  <li class="list-group-item"><a href="./../product/pro_edit.php">商品 編集</a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./../product/pro_list.php">商品 リスト</a></li>
              <li class="list-group-item"><a href="./../product/pro_ng.php">商品 NG</a></li>
            </ul>
            <p class="mt-4 fw-bold text-decoration-underline">SHOP</p>
            <ul class="list-group list-group-flush p-4 mt-2">
              <li class="list-group-item"><a href="./../shop/clear_cart.php">カート 空</a></li>
              <li class="list-group-item"><a href="./../shop/kazu_change.php">点数 変更</a></li>
              <li class="list-group-item"><a href="./../shop/shop_cartin.php">カート IN</a></li>
              <li class="list-group-item"><a href="./../shop/shop_cartlook.php">カート LOOK</a></li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./../shop/shop_form_check.php">カート フォーム チェック</a></li>
                  <li class="list-group-item"><a href="./../shop/shop_form_done.php">カート フォーム 実行</a></li>
                  <li class="list-group-item"><a href="./../shop/shop_form.php">カート フォーム</a></li>
                </ul>
              </li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./../shop/shop_list.php">ショップ リスト</a></li>
                  <li class="list-group-item"><a href="./../shop/shop_product.php">ショップ プロダクト</a></li>
                </ul>
              </li>
            </ul>
            <p class="mt-4 fw-bold text-decoration-underline">STAFF</p>
            <ul class="list-group list-group-flush p-4 mt-2">
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./staff_add_check.php">スタッフ 追加 チェック</a></li>
                  <li class="list-group-item"><a href="./staff_add_done.php">スタッフ 追加 実行</a></li>
                  <li class="list-group-item"><a href="./staff_add.php">スタッフ 追加</a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./staff_branch.php">スタッフ 枝</a></li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./staff_delete_done.php">スタッフ 削除 実行</a></li>
                  <li class="list-group-item"><a href="./staff_delete.php">スタッフ 削除</a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./staff_disp.php">スタッフ 表示</a></li>
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./staff_edit_check.php">スタッフ 編集 チェック</a></li>
                  <li class="list-group-item"><a href="./staff_edit_done.php">スタッフ 編集 実行</a></li>
                  <li class="list-group-item"><a href="./staff_edit.php">スタッフ 編集</a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./staff_list.php">スタッフ リスト</a></li>
              <li class="list-group-item"><a href="./staff_ng.php">スタッフ NG</a></li>
            </ul>
            <p class="mt-4 fw-bold text-decoration-underline">STAFF LOGIN</p>
            <ul class="list-group list-group-flush p-4 mt-2">
              <li class="list-group-item">
                <ul class="list-group list-group-horizontal">
                  <li class="list-group-item"><a href="./staff_login_check.php">ログin チェック</a></li>
                  <li class="list-group-item"><a href="./staff_login.php">ログin </a></li>
                </ul>
              </li>
              <li class="list-group-item"><a href="./staff_logout.php">ログアウト</a></li>
              <li class="list-group-item"><a href="./staff_top.php">Staff Top</a></li>
            </ul>
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