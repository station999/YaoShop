session_start();
session_regenerate_id(true);
if(!isset($_SESSION['login']))
{
    echo 'ログインされていません。<br/>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}