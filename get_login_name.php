<?php

    include('Connect.php');
    session_start();
    $sql = "SELECT `employee_name` FROM `employee` WHERE `employee_ID` = '".$_SESSION['login_ID']."'";
    
    $result = $sql_qry->query($sql);
    
    if ($result) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo $count." 失敗";
    $sql_qry = null;
?>