<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["save"])) {
        $amount = $_POST["amount"];
        $date = $_POST["date"];
        for($i=0; $i<$amount; $i++){
            $sql = "SELECT `area_ID` FROM `area` WHERE `patrol_area`='".$_POST["patrol_area".$i]."'";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $sql = "UPDATE `duty` SET `day_employee_ID1`='".$_POST["day_employee_ID1".$i]."',`day_employee_ID2`='".$_POST["day_employee_ID2".$i]."',`day_car_No`='".$_POST["day_car_number".$i]."',`night_employee_ID1`='".$_POST["night_employee_ID1".$i]."',`night_employee_ID2`='".$_POST["night_employee_ID2".$i]."',`night_car_No`='".$_POST["night_car_number".$i]."' WHERE `area_ID`='".$row['area_ID']."' AND `date`='".$date."'";
            $result = $sql_qry->query($sql);
            if (!$result) {
                echo "<script> alert('修改失敗');history.back();</script>";//
            }
        }
        
        echo "<script> alert('修改成功');location.href='edit_duty.html?date=".$date."';</script>";//
        
    }
    $sql_qry = null;
?>