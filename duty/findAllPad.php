<?php
    include("../Connect.php");

    $sql = "SELECT `pad_ID` FROM `pad` WHERE 1";
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
        
        
    } else echo "0 失敗";
    $sql_qry = null;
?>