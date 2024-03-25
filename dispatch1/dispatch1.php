<?php
    date_default_timezone_set('Asia/Taipei');
    include("../Connect.php");
    include("../check_login.php");

    if(isset($_POST["submit"])){
        
        //session_start();
        $sender_ID="test000";//$_SESSION['employee_ID'];
        $customer_ID=$_POST['customer_ID'];
        $current_state=0;
        $description=$_POST['description'];
        $receive_time= date('Y-m-d H:i:s', time());

        //找客戶簡稱 for 文字檔
        $sql = "SELECT `customer_abbreviation` FROM customer WHERE `customer_ID`= '".$customer_ID."'";
        $result = $sql_qry->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $customer_abbreviation = $row['customer_abbreviation'];
        
        
    
        $sql = "INSERT INTO `dispatch1`(`customer_ID`, `sender_ID`, `current_state`, `description`, `time`) VALUES ('".$customer_ID."','".$sender_ID."','".$current_state."','".$description."','".$receive_time."')";
        $result = $sql_qry->query($sql);
        if($result){
            echo "<script>alert('成功');</script>";

            //資訊輸入文字檔
            $employee_ID = $_SESSION['login_ID'];
            $d = date('Y-m-d');
            $t = date('H:i:s');
            $text = $t.' '.$employee_ID.'填寫'.$customer_abbreviation."的派修通報，案件說明為:".$description."。\n";
            file_put_contents("D:/dispatch_system/operation/".$d.'.txt', $text, FILE_APPEND);
            //file_put_contents("C:/xampp/htdocs/dispatch/operation/".$d.'.txt', $text, FILE_APPEND);
            echo "<script>location.href='dispatch1_report1.html'</script>";
        }
        else{
            echo "<script>alert('失敗');history.back();</script>";
        }
    

            
    }    
    $sql_qry = null;
?>