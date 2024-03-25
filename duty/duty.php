<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['search_date'])){
        $sql = "SELECT `date` FROM `duty` WHERE `date`='".$_POST['search_date']."'GROUP BY `date` ";
    }
    else{
        $sql = "SELECT `date` FROM `duty` GROUP BY `date` ORDER BY `date` DESC LIMIT 30";
    }
    $result = $sql_qry->query($sql);
    
    if ($result) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo "0 失敗";
    $sql_qry = null;
?>