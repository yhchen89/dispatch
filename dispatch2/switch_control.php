<?php
    include("../Connect.php");
    include("../check_login.php");
    
    if(isset($_POST['save'])){
        for($i=0;$i<$_POST['index'];$i++){ 
            $sql = "UPDATE `area` SET `area_switch`='".$_POST['area_switch'.$i][0]."' WHERE `patrol_area`='".$_POST['patrol_area'][$i]."'";
            $result = $sql_qry->query($sql);
            if (!$result) {
                echo "<script> alert('失敗');history.back();</script>";
            }
        }

        echo "<script> alert('成功');location.href='switch_control.html';</script>";
    }
    $sql_qry = null;
?>