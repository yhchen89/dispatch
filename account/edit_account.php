<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["submit"])) {
        $employee_ID = $_POST["account"];
        $password = $_POST["password"];
        $employee_name = $_POST["name"];
        $phone = $_POST["phone"];
        $area = $_POST["employee_area"];
        $type = $_POST["employee_type"];
        
        $sql = "UPDATE `employee` SET `employee_name`='".$employee_name."',`employee_phone`='".$phone."',`password`='".$password."',`type`='".$type."',`service_area`='".$area."' WHERE employee_ID = '".$employee_ID."'";
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('新增失敗');history.back();</script>";
        } else echo "<script> alert('新增成功');location.href='account.html';</script>";
        
    }
    $sql_qry = null;
?>