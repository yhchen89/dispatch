<?php
    include("../Connect.php");
    $sql = "SELECT `alarm_ID`,`alarm_time`,`security_receive_time`,`security_arrive_time`,`caseclose_time`,`dispatch2`.`customer_ID`,`customer_abbreviation`,`dispatch2`.`patrol_area`,`monitoring_signal`,`dispatch2`.`zone_code`,`zone`.`zone_definition`,`dispatcher_report`,`current_state`,`report`,`area_switch` 
        FROM `dispatch2` LEFT JOIN `customer` on dispatch2.customer_ID=customer.customer_ID LEFT JOIN `area` ON dispatch2.patrol_area=area.patrol_area LEFT JOIN `zone` ON dispatch2.customer_ID=zone.customer_ID AND dispatch2.zone_code=zone.zone_code 
        WHERE  ";

    $d = " DATE(`alarm_time`) = '".$_POST['date']."' ";
    $i = " `dispatch2`.`customer_ID` LIKE '%".$_POST['customer_id']."%' ";
    $n = "AND `customer_abbreviation` LIKE  '%".$_POST['customer_name']."%' ";
    $e = "AND DATEDIFF(NOW(), `alarm_time`) < 180 ORDER BY `alarm_time` DESC LIMIT 500";
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