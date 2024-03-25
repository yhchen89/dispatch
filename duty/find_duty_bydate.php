<?php
    include("../Connect.php");
    include("../check_login.php");
    $date = $_POST['date'];
    $sql = "SELECT * FROM `duty` NATURAL JOIN `area` WHERE `date`='".$date."' ORDER BY `area_ID` DESC";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
        
        
    } else echo "0 失敗";
    $sql_qry = null;
?>