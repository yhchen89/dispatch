<?php

    include("Connect.php");
    session_start();

    $sql = "SELECT `employee_name` FROM `employee` WHERE `employee_ID`='" . $_SESSION['login_ID'] ."' ;";
    $result = $sql_qry->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    # 記錄登出資訊
    date_default_timezone_set('Asia/Taipei');
    $d = date('Y-m-d');
    $t = date('H:i:s');
    $text = $t.' '.$_SESSION['login_ID']."(".$row['employee_name'].") 登出\n";
    file_put_contents("D:/dispatch_system/login/".$d.'.txt', $text, FILE_APPEND);

    //清除Session
    session_destroy();
    //導到login.php
    echo "<script> alert('已登出');location.href='../dispatch/login.html';</script>";

    /*session_start();
    $login_ID = $_SESSION['login_ID'];
        
    if(!isset($login_ID)){
        echo "<script> alert('請先登入');location.href='../login.html';</script>";
    }*/
?>