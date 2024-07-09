<?php

    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
        echo 'ログインされていません。<br/>';
        echo '<a href="./staff_login.php">ログイン画面へ</a>';
        exit();
    }

    if(isset($_POST['disp'])==true)
    {
        if(isset($_POST['procode'])==false)
        {
            header('Location:pro_ng.php');
        }
        $pro_code=$_POST['procode'];
        header('Location:pro_disp.php?procode='.$pro_code);
    }
    
    if(isset($_POST['add'])==true)
    {
        header('Location:pro_add.php');
    }
    
    if(isset($_POST['edit'])==true)
    {
        if(isset($_POST['procode'])==false)
        {
            header('Location:pro_ng.php');
        }
        $pro_code=$_POST['procode'];
        header('Location:pro_edit.php?procode='.$pro_code);
    }
    
    if(isset($_POST['delete'])==true)
    {
        if(isset($_POST['procode'])==false)
        {
            header('Location:pro_ng.php');
        }
        $pro_code=$_POST['procode'];
        header('Location:pro_delete.php?procode='.$pro_code);
    }

?>