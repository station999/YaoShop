<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません。<br/>';
    print'<a href="./../staff_login/staff_login.html>"ログインイン画面へ。</a>';
}
else
{
    print '<p>';
    print $_SESSION['staff_name'];
    print 'さんログイン中';
    print '</p>';
}
// require_once '../functions.php';
// require_once '../classes/UserLogic.php';

// $result = UserLogic::checkLogin();
// if($result) 
// {
//   header('Location: mypage.php');
//   return;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
</head>
<body>
    
<h2>ユーザ登録フォーム</h2>
<?php if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
<?php endif; ?>
<form action="staff_add_check.php" method="POST">
  <p>
    <label for="username">ユーザ名：</label>
    <input type="text" name="username">
  </p>
  <p>
    <label for="email">メールアドレス：</label>
    <input type="email" name="email">
  </p>
  <p>
    <label for="password">パスワード：</label>
    <input type="password" name="password">
  </p>
  <p>
    <label for="password_conf">パスワード確認：</label>
    <input type="password" name="password_conf">
  </p>
  <p>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="新規登録">
  </p>
</form>
  <!-- <a href="/public/staff_login_form.php">ログインする</a> -->

</body>
</html>