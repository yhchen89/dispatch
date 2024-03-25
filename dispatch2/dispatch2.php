<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['duck'])){
        #$sql = "SELECT `alarm_ID`,`alarm_time`,`security_receive_time`,`security_arrive_time`,`caseclose_time`,dispatch2.customer_ID,`customer_abbreviation`,dispatch2.patrol_area,`monitoring_signal`,`zone_code`,`dispatcher_report`,`current_state`,`area_switch` FROM `dispatch2` LEFT JOIN `customer` on dispatch2.customer_ID=customer.customer_ID LEFT JOIN `area` ON dispatch2.patrol_area=area.patrol_area WHERE `current_state` <> 3 ORDER BY `alarm_time` ASC";
        $sql = "SELECT`alarm_ID`,`alarm_time`,`security_receive_time`,`security_arrive_time`,`caseclose_time`, dispatch2.customer_ID, dispatch2.patrol_area,`monitoring_signal`,dispatch2.zone_code,`dispatcher_report`,`current_state`,
            `customer_abbreviation`,
            `area_switch`, `area_ID` ,
            zone.zone_definition,
            `monitor_signal`.`signal_switch`
            FROM `dispatch2` 
            LEFT JOIN `customer`       on dispatch2.customer_ID=customer.customer_ID 
            LEFT JOIN `area`           ON dispatch2.patrol_area=area.patrol_area 
            LEFT JOIN `zone`           ON dispatch2.customer_ID=zone.customer_ID AND dispatch2.zone_code=zone.zone_code 
            LEFT JOIN `monitor_signal` ON dispatch2.monitoring_signal = monitor_signal.signal_name 
            WHERE `current_state` <> 4 
            ORDER BY `alarm_time` 
            DESC LIMIT 100";
        $result = $sql_qry->query($sql);
    
        if ($result) {
            //echo "<script> alert('成功');</script>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                echo json_encode($row,JSON_UNESCAPED_UNICODE).'&';
                #echo json_encode($row,JSON_UNESCAPED_UNICODE);
            }
        } else echo $count." 失敗";
    }
    $sql_qry = null;
?>