<?php
    session_start();
    $login_ID = $_SESSION['login_ID'];
        
    if(!isset($login_ID)){
        echo "<script> alert('請先登入');location.href='../login.html';</script>";
    }
?>