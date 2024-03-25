<?php
    include("Connect.php");
    if (isset($_POST["Submit"])) {
        $employee_ID = $_POST["Account"];
        $password = $_POST["Password"];
	
        

        session_start();
        $_SESSION['login_ID']=$employee_ID;
        $_SESSION['password']=$password;

        
        $sql = "SELECT `employee_name` FROM `employee` WHERE `employee_ID`='" . $employee_ID . "' AND `password`='" . $password . "' AND (`type` = 0 OR `type` = 3)";
        $result = $sql_qry->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo "<script> alert('帳號或密碼錯誤');history.back();</script>";
        } 
        else {
            # 記錄登入資訊
            date_default_timezone_set('Asia/Taipei');
            $d = date('Y-m-d');
            $t = date('H:i:s');
            $text = $t.' '.$employee_ID."(".$row['employee_name'].") 登入\n";
            file_put_contents("D:/dispatch_system/login/".$d.'.txt', $text, FILE_APPEND);

            header("location:account/account.html");
        }
    }
?>