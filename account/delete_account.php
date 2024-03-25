<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["submit"])) {
        $employee_ID = $_POST["account"];
        
        $sql = "DELETE FROM `employee` WHERE employee_ID = '".$employee_ID."'";
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('刪除失敗');history.back();</script>";
        } else echo "<script> alert('刪除成功');location.href='account.html'</script>";
        
    }
    $sql_qry = null;
?>