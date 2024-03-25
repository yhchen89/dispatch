<?php
    include("../Connect.php");
    include("../check_login.php");
    if (isset($_POST["save"])) {

        $customer_ID = $_POST["customer_ID"];
        $customer_name = $_POST["customer_name"];
        $customer_abbreviation = $_POST["customer_abbreviation"];
        $open_date = $_POST["open_date"];
        $close_date = $_POST["close_date"];
        $phone = $_POST["phone"];
        $principal = $_POST["principal"];
        $cellphone = $_POST["cellphone"];
        $card_number = $_POST["card_number"];
        $address = $_POST["address"];
        $service_area = $_POST["service_area"];
        $patrol_area = $_POST["patrol_area"];
        $edit_num = $_POST["edit_num"];
        $test_time = $_POST["test_time"];
        $transmit_method = $_POST["transmit_method"];
        $note = $_POST["note"];
        $setting_weekdays = $_POST["setting_weekdays"];
        $remove_weekdays = $_POST["remove_weekdays"];
        $setting_Sat = $_POST["setting_Sat"];
        $remove_Sat = $_POST["remove_Sat"];
        $setting_Sun = $_POST["setting_Sun"];
        $remove_Sun = $_POST["remove_Sun"];
        $priority = $_POST["priority"];
        
        //echo "<script> alert('".$_POST['card_number'][0]."');history.back();</script>";
        $contact_amount = $_POST["contact_amount"];
        for($i=0; $i<$contact_amount; $i++){
            $contact_ID = $_POST['contact_ID'][$i];
            $card_No = $_POST['card_No'][$i];
            $card_name = $_POST['card_name'][$i];
            $phone1 = $_POST['phone1'][$i];
            $phone2 = $_POST['phone2'][$i];
            $card_description = $_POST['card_description'][$i];
            //$card_note = $_POST['card_note'][$i];

            $sql = "UPDATE `contact` SET `card_number`='".$card_No."',`card_name`='".$card_name."',`phone1`='".$phone1."',`phone2`='".$phone2."',`card_description`='".$card_description."' WHERE `customer_ID`='".$customer_ID."' AND `contact_ID`='".$contact_ID."'";
            $result = $sql_qry->query($sql);
        
            if (!$result) {
                echo "<script> alert('聯絡人修改失敗');history.back();</script>";
            }
        }

        $zone_amount = $_POST["zone_amount"];
        for($i=0; $i<$zone_amount; $i++){
            $zone_code = $_POST['zone_code'][$i];
            $zone_definition = $_POST['zone_definition'][$i];
          
            $sql = "UPDATE `zone` SET `zone_definition`='".$zone_definition."' WHERE `customer_ID`='".$customer_ID."' AND `zone_code`='".$zone_code."'" ;
            $result = $sql_qry->query($sql);
        
            if (!$result) {
                echo "<script> alert('迴路定義修改失敗');history.back();</script>";
            }
        }

        $sql = "UPDATE `customer` SET `customer_name`='".$customer_name."',`customer_abbreviation`='".$customer_abbreviation."',`open_date`='".$open_date."',`close_date`='".$close_date."',`phone`='".$phone."',`principal`='".$principal."',`cellphone`='".$cellphone."',`card_number`='".$card_number."',`address`='".$address."',`service_area`='".$service_area."',`patrol_area`='".$patrol_area."',`test_time`='".$test_time."',`transmit_method`='".$transmit_method."',`setting_weekdays`='".$setting_weekdays."',`remove_weekdays`='".$remove_weekdays."',`setting_Sat`='".$setting_Sat."',`remove_Sat`='".$remove_Sat."',`setting_Sun`='".$setting_Sun."',`remove_Sun`='".$remove_Sun."',`note`='".$note."',`priority`='".$priority."' WHERE `customer_ID`='".$customer_ID."'";
    
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('修改失敗');history.back();</script>";//
        } else echo "<script> alert('修改成功');location.href='edit_customer.html?id=".$customer_ID."';</script>";//
    
    }
    elseif(isset($_POST["add_contact"])){
        $customer_ID=$_POST["customer_ID_2"];
        $contact_ID=$_POST["contact_ID_2"];
        $card_number=$_POST["card_number_2"];
        $card_name=$_POST["card_name_2"];
        $phone1=$_POST["phone1_2"];
        $phone2=$_POST["phone2_2"];
        $card_description=$_POST["card_description_2"];
        $card_note=$_POST["card_note_2"];

        $sql = "INSERT INTO `contact`(`customer_ID`, `contact_ID`, `card_number`, `card_name`, `phone1`, `phone2`, `card_description`, `card_note`) VALUES ('".$customer_ID."','".$contact_ID."','".$card_number."','".$card_name."','".$phone1."','".$phone2."','".$card_description."','".$card_note."')";
        
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('聯絡人新增失敗');history.back();</script>";
        } else echo "<script> alert('聯絡人新增成功');location.href='edit_customer.html?id=".$customer_ID."';</script>";
    }

    elseif(isset($_POST["add_zone"])){
        $customer_ID=$_POST["customer_ID_3"];
        $zone_code=$_POST["zone_code_3"];
        $zone_definition=$_POST["zone_definition_3"];

        $sql = "INSERT INTO `zone`(`customer_ID`, `zone_code`, `zone_definition`) VALUES ('".$customer_ID."','".$zone_code."','".$zone_definition."')";
        
        $result = $sql_qry->query($sql);
        
        if (!$result) {
            echo "<script> alert('迴路定義新增失敗');history.back();</script>";//
        } else echo "<script> alert('迴路定義新增成功');location.href='edit_customer.html?id=".$customer_ID."';</script>";//
    }
    $sql_qry = null;
?>