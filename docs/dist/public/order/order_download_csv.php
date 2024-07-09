<?php
    session_start();
?>
<?php
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
    echo 'ログインされていません。<br/>';
    echo '<a href="./staff_login.php">ログイン画面へ</a>';
    exit();
    }
?>
<?php
    $filePath='../tmp/export.csv';

    header('Content-Type: text/csv');
    header('Content-Length: ' . filesize($filePath)); 
    header('Content-Disposition: attachment; filename=download_.csv'); 
    header('Content-Transfer-Encoding: binary');
    
    readfile($filePath);

    unlink($filePath);
?>