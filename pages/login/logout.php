<?php
    session_start();// access the current session
    // if no session variable exists then redirect the user
    if(!isset($_SESSION['user_Id']))
    {
        header("Location: index.php");
        exit();
    }
    else
    {
        $_SESSION = array();//destroy the variables.
        session_destroy();// destroy the session
        setcookie('PHPSESSID', ", time()-3600, '/',", 0,0);//destory the cookie
        header("Location: index.php");
        exit();
    }
?>