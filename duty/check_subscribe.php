<?php
    include("../Connect.php");
    
    if(isset($_POST['save'])){
        $sql = "SELECT `user_line_ID` FROM `pad` WHERE `pad_ID`='".$_POST['pad_ID']."'";
        $result = $sql_qry->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $user_line_ID = $row['user_line_ID'];
        for($i=0;$i<$_POST['index'];$i++){ 
            $sql = "SELECT `area_ID` FROM `area` WHERE `patrol_area`='".$_POST['patrol_area'.$i][0]."'";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $area_ID = $row['area_ID'];
            
            if($_POST['traversal'.$i][0]==0){
                $sql = "DELETE FROM `user_line` WHERE `user_line_ID`='".$user_line_ID."' AND `area_ID`='".$area_ID."'";
                //echo "<script> alert('取消追蹤');</script>";
            }
            else{
                $sql = "SELECT * FROM `user_line` WHERE `user_line_ID`='".$user_line_ID."' AND `area_ID`='".$area_ID."'";
                $result = $sql_qry->query($sql);
                $row = $result->fetch(PDO::FETCH_NUM);
                if(!empty($row))
                    continue;
                $sql = "INSERT INTO `user_line`(`user_line_ID`, `area_ID`) VALUES ('".$user_line_ID."','".$area_ID."')";
                //echo "<script> alert('追蹤');</script>";
            }
            $result = $sql_qry->query($sql);
            if (!$result) {

                echo "<script> alert('失敗');history.back();</script>";//
            }
        }

        echo "<script> alert('成功');location.href='check_subscribe.html';</script>";//
    }
?>