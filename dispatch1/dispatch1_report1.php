<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['current_state'])){
        $sql = "SELECT `time`, `dispatch1_ID`, `customer_ID`, `customer_abbreviation`, `description`, `current_state`, `security_receive_time`,`security_arrive_time`, `caseclose_time`,`dispatcher_report`,area.area_ID,area.patrol_area FROM(SELECT dispatch1.time, dispatch1.dispatch1_ID, customer.customer_ID, customer.customer_abbreviation, dispatch1.description,dispatch1.current_state,dispatch1.security_receive_time,dispatch1.security_arrive_time,dispatch1.caseclose_time,dispatch1.dispatcher_report,customer.service_area,customer.patrol_area FROM dispatch1 INNER JOIN customer ON customer.customer_ID=dispatch1.customer_ID WHERE current_state <> 4) as a LEFT JOIN `area` ON area.service_area=a.service_area AND area.patrol_area=a.patrol_area ORDER BY `time` ASC";
        //$sql = "SELECT dispatch1.time, dispatch1.dispatch1_ID, customer.customer_ID, customer.customer_abbreviation, dispatch1.description, dispatch1.current_state, dispatch1.security_receive_time, dispatch1.security_arrive_time, dispatch1.caseclose_time,dispatch1.dispatcher_report FROM dispatch1 INNER JOIN customer ON customer.customer_ID=dispatch1.customer_ID WHERE current_state <> 3 ORDER BY `time` ASC";
    }
    
    $result = $sql_qry->query($sql);
    
    if ($result) {
        #echo "<script> alert('成功');</script>";
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'&';
        }
    } else echo $count." 失敗";
    $sql_qry = null;
?>
