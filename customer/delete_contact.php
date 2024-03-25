<?php
    include("../Connect.php");
    include("../check_login.php");
    $customer_ID = $_POST["customer_ID"];
    $contact_ID = $_POST["contact_ID"];

    $sql = "DELETE FROM `contact` WHERE `customer_ID` = '".$customer_ID."' AND `contact_ID` = '".$contact_ID."'";
    $result = $sql_qry->query($sql);
    
    if (!$result) {
        echo "0 失敗";
    } else echo "成功";
    
    $sql_qry = null;
?>