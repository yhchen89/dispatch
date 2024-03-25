<?php
    include("../Connect.php");
    include("../check_login.php");
    $customer_ID = $_POST['customer_ID'];
    $sql = "SELECT * FROM `customer` WHERE customer_ID='".$customer_ID."'";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        
    } else echo "0 失敗";
    $sql_qry = null;
?>