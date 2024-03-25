<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["submit"])) {
        $alarm_ID = $_POST['alarm_ID_new'];
        //$customer_ID = $_POST['customer_ID_new'];
        $report = $_POST['note1'];


        //找客戶簡稱 for 文字檔
        $sql = "SELECT `customer_abbreviation` FROM dispatch2 INNER JOIN customer ON dispatch2.customer_ID=customer.customer_ID 
                WHERE `alarm_ID`= '".$alarm_ID."'";
        $result = $sql_qry->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $customer_abbreviation = $row['customer_abbreviation'];


        $sql = "UPDATE `dispatch2` SET `report`='".$report."',`current_state` = 4,`caseclose_time` = NOW() WHERE alarm_ID = '".$alarm_ID."'";
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('派勤結案失敗');history.back();</script>";
        } else {
            echo "<script> alert('派勤結案成功');</script>";

            //資訊輸入文字檔
            $employee_ID = $_SESSION['login_ID'];
            date_default_timezone_set('Asia/Taipei');
            $d = date('Y-m-d');
            $t = date('H:i:s');
            $text = $t.' '.$employee_ID.'已完成'.$customer_abbreviation."的派勤結案回報，回報內容為:".$report."。\n";
            file_put_contents("D:/dispatch_system/operation/".$d.'.txt', $text, FILE_APPEND);
            //file_put_contents("C:/xampp/htdocs/dispatch/operation/".$d.'.txt', $text, FILE_APPEND);
            echo "<script>location.href='dispatch2.html'</script>";
        }
    }
    $sql_qry = null;
?>