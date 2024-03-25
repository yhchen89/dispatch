<?php
    include("../Connect.php");
    include("../check_login.php");
    $customer_ID = $_POST["customer_ID"];
    $zone_code = $_POST["zone_code"];

    $sql = "DELETE FROM `zone` WHERE `customer_ID` = '".$customer_ID."' AND `zone_code` = '".$zone_code."'";
    $result = $sql_qry->query($sql);
    
    if (!$result) {
        echo "0 失敗";
    } else echo "成功";
    
    $sql_qry = null;
?>