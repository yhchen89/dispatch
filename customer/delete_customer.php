<?php
    date_default_timezone_set('Asia/Taipei');
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

        $f = fopen("D:/dispatch_system/deleted_customer/".$customer_ID."_".date("Ymd").".txt" ,"w");
        fwrite($f, "customer_name:".$customer_name."\r\n");
        fwrite($f, "customer_abbreviation:".$customer_abbreviation."\r\n");
        fwrite($f, "open_date:".$open_date."\r\n");
        fwrite($f, "close_date:".$close_date."\r\n");
        fwrite($f, "phone:".$phone."\r\n");
        fwrite($f, "principal:".$principal."\r\n");
        fwrite($f, "cellphone:".$cellphone."\r\n");
        fwrite($f, "card_number:".$card_number."\r\n");
        fwrite($f, "address:".$address."\r\n");
        fwrite($f, "service_area:".$service_area."\r\n");
        fwrite($f, "patrol_area:".$patrol_area."\r\n");
        fwrite($f, "edit_num:".$edit_num."\r\n");
        fwrite($f, "test_time:".$test_time."\r\n");
        fwrite($f, "transmit_method:".$transmit_method."\r\n");
        fwrite($f, "note:".$note."\r\n");
        fwrite($f, "setting_weekdays:".$setting_weekdays."\r\n");
        fwrite($f, "remove_weekdays:".$remove_weekdays."\r\n");
        fwrite($f, "setting_Sat:".$setting_Sat."\r\n");
        fwrite($f, "remove_Sat:".$remove_Sat."\r\n");
        fwrite($f, "setting_Sun:".$setting_Sun."\r\n");
        fwrite($f, "remove_Sun:".$remove_Sun."\r\n");
        fwrite($f, "priority:".$priority."\r\n");
        fwrite($f, "transmit_method:".$transmit_method."\r\n");

        //echo "<script> alert('".$_POST['card_number'][0]."');history.back();</script>";
        $contact_amount = $_POST["contact_amount"];
        for($i=0; $i<$contact_amount; $i++){
            $contact_ID = $_POST['contact_ID'][$i];
            $card_No = $_POST['card_No'][$i];
            $card_name = $_POST['card_name'][$i];
            $phone1 = $_POST['phone1'][$i];
            $phone2 = $_POST['phone2'][$i];
            $card_description = $_POST['card_description'][$i];
            $card_note = $_POST['card_note'][$i];

            fwrite($f, "No:".$i."\r\n");
            fwrite($f, "contact_ID:".$contact_ID."\r\n");
            fwrite($f, "card_No:".$card_No."\r\n");
            fwrite($f, "card_name:".$card_name."\r\n");
            fwrite($f, "phone1:".$phone1."\r\n");
            fwrite($f, "phone2:".$phone2."\r\n");
            fwrite($f, "card_description:".$card_description."\r\n");
            fwrite($f, "card_note:".$card_note."\r\n");

            $sql = "DELETE FROM `contact` WHERE `customer_ID`='".$customer_ID."' AND `contact_ID`='".$contact_ID."'";
            $result = $sql_qry->query($sql);
        
            if (!$result) {
                echo "<script> alert('聯絡人刪除失敗');history.back();</script>";//
            }
        }

        $zone_amount = $_POST["zone_amount"];
        for($i=0; $i<$zone_amount; $i++){
            $zone_code = $_POST['zone_code'][$i];
            $zone_definition = $_POST['zone_definition'][$i];

            fwrite($f, "No::".$i."\r\n");
            fwrite($f, "zone_code:".$zone_code."\r\n");
            fwrite($f, "zone_definition:".$zone_definition."\r\n");
          
            $sql = "DELETE FROM `zone` WHERE `customer_ID`='".$customer_ID."' AND `zone_code`='".$zone_code."'" ;
            $result = $sql_qry->query($sql);
        
            if (!$result) {
                echo "<script> alert('迴路定義刪除失敗');history.back();</script>";//
            }
        }

        $sql = "UPDATE `customer` SET `customer_name`='',`customer_abbreviation`='',`open_date`='',`close_date`='',`phone`='',`principal`='',`cellphone`='',`card_number`='',`address`='',`service_area`='',`patrol_area`='',`test_time`='',`transmit_method`='',`setting_weekdays`='',`remove_weekdays`='',`setting_Sat`='',`remove_Sat`='',`setting_Sun`='',`remove_Sun`='',`note`='',`priority`='', `edit_num`='' WHERE `customer_ID`='".$customer_ID."'";
    
        $result = $sql_qry->query($sql);
        fclose($f);
        if (!$result) {
            echo "<script> alert('刪除失敗');history.back();</script>";//
        } else echo "<script> alert('刪除成功');location.href='customer.html';</script>";//
    
    }
    $sql_qry = null;
?>