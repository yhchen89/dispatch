<?php
    include("../Connect.php");
    include("../check_login.php");
    if(isset($_POST['save'])){
        for($i=0;$i<$_POST['index'];$i++){ 
            $sql = "UPDATE `monitor_signal` SET `signal_switch`='".$_POST['signal_switch'.$i][0]."' WHERE `signal_name`='".$_POST['signal_name'][$i]."'";
            $result = $sql_qry->query($sql);
            if (!$result) {
                echo "<script> alert('失敗');history.back();</script>";
            }
        }

        echo "<script> alert('成功');location.href='switch_signal.html';</script>";
    }
    $sql_qry = null;
?>