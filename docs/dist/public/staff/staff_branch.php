<?php

    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
        echo '<p>ログインされていません。</p>';
        echo '<a href="./staff_login.php">ログイン画面へ</a>';
        exit();
    }

    if(isset($_POST['disp'])==true)
    {
        if(isset($_POST['staffcode'])==false)
        {
            header('Location:staff_ng.php');
        }
        $staff_code=$_POST['staffcode'];
        header('Location:staff_disp.php?staffcode='.$staff_code);
    }

    if(isset($_POST['add'])==true)
    {
        header('Location:staff_add.php');
    }

    if(isset($_POST['edit'])==true)
    {
        if(isset($_POST['staffcode'])==false)
        {
            header('Location:staff_ng.php');
        }
        $staff_code=$_POST['staffcode'];
        header('Location:staff_edit.php?staffcode='.$staff_code);
    }
    
    if(isset($_POST['delete'])==true)
    {
        if(isset($_POST['staffcode'])==false)
        {
            header('Location:staff_ng.php');
        }
        $staff_code=$_POST['staffcode'];
        header('Location:staff_delete.php?staffcode='.$staff_code);
    }

?>