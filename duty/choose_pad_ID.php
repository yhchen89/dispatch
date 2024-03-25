<?php
    include("../Connect.php");
    $pad_ID = $_POST['pad_ID'];
    $sql = "SELECT * FROM `pad` NATURAL JOIN `user_line` NATURAL JOIN `area` WHERE `pad_ID`='".$pad_ID."'";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
        
        
    } else echo "0 失敗";
    $sql_qry = null;
?>