<?php
    include("../Connect.php");
    include("../check_login.php");
    $patrol_area = $_POST['patrol_area'];
    $sql = "SELECT `customer_ID`, `customer_abbreviation`FROM `customer` WHERE `patrol_area`='".$patrol_area."'";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo "0 失敗";
    $sql_qry = null;
?>