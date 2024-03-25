<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["submit"])) {
        $employee_ID = $_POST["account"];
        $password = $_POST["password"];
        $employee_name = $_POST["name"];
        /*foreach ($_POST["employee_area"] as $a){
            echo "<script> alert('".$a."');</script>";
            $sql = "INSERT INTO `in charge`(`employee_ID`, `area_ID`) VALUES ('".$employee_ID."','".$a."')";
            $result = $sql_qry->query($sql);
            if (!$result) 
                echo "<script> alert('新增失敗');history.back();</script>";
        }*/
        
        $phone = $_POST["phone"];
        $area = $_POST["employee_area"];
        $type = $_POST["employee_type"];

        
        $sql = "INSERT INTO `employee`(`employee_ID`, `employee_name`, `employee_phone`, `service_area`, `password`, `type`) VALUES ('".$employee_ID."','".$employee_name."','".$phone."','".$area."','".$password."','".$type."')";
        $result = $sql_qry->query($sql);

        if (!$result) {
            echo "<script> alert('新增失敗');history.back();</script>";//
        } else echo "<script> alert('新增成功');location.href = 'account.html'</script>";//
        
    }
    $sql_qry = null;
?>