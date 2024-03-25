<?php
    include("../Connect.php");
    include("../check_login.php");
    $service_area = $_POST['service_area'];
    $sql = "SELECT * FROM `area` WHERE `service_area`='".$service_area."'";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo "0 失敗";
    $sql_qry = null;
?>