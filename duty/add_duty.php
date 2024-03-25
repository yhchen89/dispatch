<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["save"])) {
        $date = $_POST['date'];
        for($i = 0; $i < $_POST['amount']; $i++){
            
            $patrol_area = $_POST["patrol_area".$i];
            $day_employee_ID1 = $_POST["day_employee_ID1".$i];
            $day_employee_ID2 = $_POST["day_employee_ID2".$i];
            $day_car_number = $_POST["day_car_number".$i];
            $night_employee_ID1 = $_POST["night_employee_ID1".$i];
            $night_employee_ID2 = $_POST["night_employee_ID2".$i];
            $night_car_number = $_POST["night_car_number".$i];

            $sql = "SELECT `area_ID` FROM `area` WHERE `patrol_area`='".$patrol_area."'";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $sql = "INSERT INTO `duty`(`date`, `area_ID`, `day_employee_ID1`, `day_employee_ID2`, `day_car_No`, `night_employee_ID1`, `night_employee_ID2`, `night_car_No`) VALUES ('".$date."','".$row['area_ID']."','".$day_employee_ID1."','".$day_employee_ID2."','".$day_car_number."','".$night_employee_ID1."','".$night_employee_ID2."','".$night_car_number."')";
            
            $result = $sql_qry->query($sql);

            if (!$result) {
                echo "<script> alert('新增失敗');history.back();</script>";
            }
        }

        echo "<script> alert('新增成功');location.href = 'duty.html';</script>";
        
    }
    $sql_qry = null;
?>