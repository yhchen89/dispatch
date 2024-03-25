<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['search_type'])){
        $sql = "SELECT * FROM `employee` WHERE employee.type ='".$_POST['search_type']."'";
        $count = 1;
        if(isset($_POST['search_area'])){
            
            foreach ($_POST['search_area'] as $a){
                $s = '';
                if($count==1){
                    $s = "AND (employee.service_area ='".$a."'";
                }
                else{
                    $s = "OR employee.service_area ='".$a."'";
                }
                $sql = $sql.$s;
                $count = $count+1;
            }
        }

        if($count!=1){
            $sql = $sql.")";
        }
    }
    else{
        $sql = "SELECT * FROM `employee` WHERE 1";
    }
    $result = $sql_qry->query($sql);
    
    if ($result) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row,JSON_UNESCAPED_UNICODE).'@@@';
        }
    } else echo $count." 失敗";
    $sql_qry = null;
?>