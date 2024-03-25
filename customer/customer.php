<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['customer_ID'])){
        $sql = "SELECT `customer_ID`, `customer_abbreviation`, `phone`, `principal`, `service_area` , `patrol_area` FROM `customer` WHERE `customer_ID` ='".$_POST['customer_ID']."'";
    }
    else{
        $sql = "SELECT `customer_ID`, `customer_abbreviation`, `phone`, `principal`, `service_area` , `patrol_area` FROM `customer` WHERE 1";
    }
    $result = $sql_qry->query($sql);
    
    if ($result) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo $count." 失敗";
    $sql_qry = null;
?>