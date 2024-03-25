<?php
    include("../Connect.php");
    include("../check_login.php");

    $sql = "SELECT `time`,`security_receive_time`,`security_arrive_time`,
    `caseclose_time`,`customer_abbreviation`,`patrol_area`,`description`,
    `dispatcher_report`,`report`,`current_state`,`dispatch1`.`customer_ID`
    FROM dispatch1 INNER JOIN customer ON dispatch1.customer_ID=customer.customer_ID 
    WHERE  ";

    $d = " DATE(`time`) = '".$_POST['date']."' ";
    $i = " `dispatch1`.`customer_ID` LIKE '%".$_POST['customer_id']."%' ";
    $n = "AND `customer_abbreviation` LIKE  '%".$_POST['customer_name']."%' ";
    $e = "AND DATEDIFF(NOW(), `time`) < 180 ORDER BY `time` DESC LIMIT 500";
    if (!empty($_POST['date']))
        $sql = $sql.$d.'AND'.$i.$n.$e;
    else{
        $sql = $sql.$i.$n.$e;
    }  
        


    //echo "<script> alert('".$sql."');</script>";
    $result = $sql_qry->query($sql);
    if ($result) {
            
        //echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'&';
            #echo json_encode($row,JSON_UNESCAPED_UNICODE);
        }

    }
    
    $sql_qry = null;
?>