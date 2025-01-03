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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">  
    <link rel="stylesheet" href="C:/P/station/YaoShop/docs/dist/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>八百八：ログインチェック</title>
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
                <h1>スタッフ ログインチェック画面</h1>
              </div>
            </div>
          </section>
          <section class="container p-4">
            <?php
                //- ob_start();
                //- session_start();
                try
                {
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
                        echo '<p>';
                        echo 'スタッフコードかパスワードが間違っています。';
                        echo '</p>';
                    }      
                }
                catch(Exception $e)
                {
                    echo '<p>';
                    echo '通信障害のため確認できませんでした。<br/>';
                    echo '</p>';
                    echo '<p>';
                    echo '大変ご迷惑をおかけしております。';
                    echo '</p>';
                    exit();
                }
                //- ob_end_flush();
            ?>
            
            
            <button class="btn btn-warning my-3" type="button"><a href="./staff_login.php">戻る</a></button>
          </section>
        </main>
      </div>
      <footer class="st_footer footer">
        <div class="container text-bg-dark p-1">
          <hr class="hr_footer-line">
          <div class="row mx-auto text-white">
       