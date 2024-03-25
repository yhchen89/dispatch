<?php
# access編碼: big5 !!!
include("../Connect.php");
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
    $target_dir = "C:/xampp/htdocs/dispatch/uploads/";
    $target_file = $target_dir . pathinfo($_FILES['my_file']['name'], PATHINFO_BASENAME);
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $target_file)) {
        // access file
        $mdb_file = $target_file;
        $driver = '{Microsoft Access Driver (*.mdb, *.accdb)}';
        $dataSourceName = "odbc:Driver=$driver;DBQ=$mdb_file;";
        $access_qry = new PDO($dataSourceName);

        // 聯絡人
        $access_sql = "SELECT * FROM `X連絡` WHERE 1";
        $access_sql = mb_convert_encoding($access_sql,"big5");
        $access_result = $access_qry->query($access_sql);
        
        while($access_row = $access_result->fetch(PDO::FETCH_ASSOC)){
            $customer_ID = mb_convert_encoding($access_row[mb_convert_encoding("客戶代號","big5")],"utf-8","big5");
            $contact_ID = mb_convert_encoding($access_row[mb_convert_encoding("持卡代號","big5")],"utf-8","big5");
            $card_number = mb_convert_encoding($access_row[mb_convert_encoding("持卡卡號","big5")],"utf-8","big5");
            $card_name = mb_convert_encoding($access_row[mb_convert_encoding("持卡名稱","big5")],"utf-8","big5");
            $phone1 = mb_convert_encoding($access_row[mb_convert_encoding("電話1","big5")],"utf-8","big5");
            $phone2 = mb_convert_encoding($access_row[mb_convert_encoding("電話2","big5")],"utf-8","big5");
            $card_description = mb_convert_encoding($access_row[mb_convert_encoding("持卡說明","big5")],"utf-8","big5");
            $card_note = mb_convert_encoding($access_row[mb_convert_encoding("持卡備註","big5")],"utf-8","big5");

            $sql = "SELECT * FROM `contact` WHERE `customer_ID`='".$customer_ID."' AND `contact_ID`='".$contact_ID."'";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_BOTH);
            if(empty($row)){
                $sql = "INSERT INTO `contact`(`customer_ID`, `contact_ID`, `card_number`, `card_name`, `phone1`, `phone2`, `card_description`, `card_note`) VALUES ('".$customer_ID."','".$contact_ID."','".$card_number."','".$card_name."','".$phone1."','".$phone2."','".$card_description."','".$card_note."')";
                echo "insert";
            }
            else{
                $sql = "UPDATE `contact` SET `card_number`='".$card_number."',`card_name`='".$card_name."',`phone1`='".$phone1."',`phone2`='".$phone2."',`card_description`='".$card_description."',`card_note`='".$card_note."' WHERE `customer_ID`='".$customer_ID."' AND `contact_ID`='".$contact_ID."'";
            }
            $result = $sql_qry->query($sql);
            if (!$result) {    
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
        
        // 迴路
        $access_sql = "SELECT * FROM `X迴路` WHERE 1";
        $access_sql = mb_convert_encoding($access_sql,"big5");
        $access_result = $access_qry->query($access_sql);
        
        while($access_row = $access_result->fetch(PDO::FETCH_ASSOC)){
            $customer_ID = mb_convert_encoding($access_row[mb_convert_encoding("客戶代號","big5")],"utf-8","big5");
            $zone_code = mb_convert_encoding($access_row[mb_convert_encoding("迴路代號","big5")],"utf-8","big5");
            $zone_No = mb_convert_encoding($access_row[mb_convert_encoding("迴路編號","big5")],"utf-8","big5");
            $zone_definition = mb_convert_encoding($access_row[mb_convert_encoding("迴路說明","big5")],"utf-8","big5");
            
            $sql = "SELECT * FROM `zone` WHERE `customer_ID`='".$customer_ID."' AND `zone_code`='".$zone_code."'";
            $result = $sql_qry->query($sql);
            $row = $result->fetch(PDO::FETCH_BOTH);
            if(empty($row)){
                $sql = "INSERT INTO `zone`(`customer_ID`, `zone_code`, `zone_No`, `zone_definition`) VALUES ('".$customer_ID."','".$zone_code."','".$zone_No."','".$zone_definition."')";
                echo "zone insert";
            }
            else{
                $sql = "UPDATE `zone` SET `zone_No`='".$zone_No."',`zone_definition`='".$zone_definition."' WHERE `customer_ID`='".$customer_ID."' AND `zone_code`='".$zone_code."'";
            }
            
            $result = $sql_qry->query($sql);
            if (!$result) {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }

        // 客戶資料
        $access_sql = "SELECT * FROM `X資料` WHERE 1";
        $access_sql = mb_convert_encoding($access_sql,"big5");
        $access_result = $access_qry->query($access_sql);
        
        //echo $customer_ID."</br>";
        $customer_ID = "";
        //echo $customer_ID;
        $access_row = $access_result->fetch(PDO::FETCH_ASSOC);
        $col_data = mb_convert_encoding($access_row[mb_convert_encoding("欄位資料","big5")],"utf-8","big5");
        $customer_ID = explode("  ",$col_data)[0];
        $customer_name="";
        $customer_abbreviation="";
        $open_date="";
        $close_date="";
        $phone="";
        $principal="";
        $cellphone="";
        $card_number="";
        $address="";
        $service_area="";
        $patrol_area="";
        $edit_num="";
        $test_time="";
        $transmit_method="";      
        $setting_weekdays="";
        $remove_weekdays="";
        $setting_Sat="";
        $remove_Sat="";
        $setting_Sun="";
        $remove_Sun="";
        $priority="";
        $note="";
        while($access_row = $access_result->fetch(PDO::FETCH_ASSOC)){

            if(mb_convert_encoding($access_row[mb_convert_encoding("客戶代號","big5")],"utf-8","big5")!=$customer_ID){
                $sql = "UPDATE `customer` SET `customer_name`='".$customer_name."',`customer_abbreviation`='".$customer_abbreviation."',`open_date`='".$open_date."',`close_date`='".$close_date."',`phone`='".$phone."',`principal`='".$principal."',`cellphone`='".$cellphone."',`card_number`='".$card_number."',`address`='".$address."',`service_area`='".$service_area."',`patrol_area`='".$patrol_area."',`test_time`='".$test_time."',`transmit_method`='".$transmit_method."',`setting_weekdays`='".$setting_weekdays."',`remove_weekdays`='".$remove_weekdays."',`setting_Sat`='".$setting_Sat."',`remove_Sat`='".$remove_Sat."',`setting_Sun`='".$setting_Sun."',`remove_Sun`='".$remove_Sun."',`note`='".$note."',`priority`='".$priority."' WHERE `customer_ID`='".$customer_ID."'";
                $result = $sql_qry->query($sql);
                if (!$result) {
                    echo "<script>alert('Sorry, there was an error uploading your file.');history.back();</script>";
                }
                $customer_ID = mb_convert_encoding($access_row[mb_convert_encoding("客戶代號","big5")],"utf-8","big5");
            }
                
            $col_name = mb_convert_encoding($access_row[mb_convert_encoding("欄位名稱","big5")],"utf-8","big5");
            $col_data = mb_convert_encoding($access_row[mb_convert_encoding("欄位資料","big5")],"utf-8","big5");
            switch ($col_name) {
                case "客戶名稱":
                    $customer_name=$col_data;
                    break;
                case "客戶簡稱":
                    $customer_abbreviation=$col_data;
                    break;
                case "開通日期":
                    $open_date=$col_data;
                    break;
                case "關閉日期":
                    $close_date=$col_data;
                    break;
                case "傳訊電話":
                    $phone=$col_data;
                    break;
                case "負責人":
                    $principal=$col_data;
                    break;
                case "電話":
                    $cellphone=$col_data;
                    break;
                case "卡號":
                    $card_number=$col_data;
                    break;
                case "地址":
                    $address=$col_data;
                    break;
                case "營業處":
                    $service_area=$col_data;
                    break;
                case "巡邏區":
                    $tmp_sql = "SELECT * FROM `patrol_area` WHERE `patrol_ID`='".$col_data."'";
                    $tmp_sql = mb_convert_encoding($tmp_sql,"big5");
                    $tmp_result = $access_qry->query($tmp_sql);
                    $tmp_row = $tmp_result->fetch(PDO::FETCH_ASSOC);
                    $patrol_area=mb_convert_encoding($tmp_row[mb_convert_encoding("patrol_name","big5")],"utf-8","big5");
                    //echo mb_convert_encoding($tmp_row[mb_convert_encoding("patrol_name","big5")],"utf-8","big5");
                    break;
                case "編修者":
                    $edit_num=$col_data;
                    break;
                case "回測時間":
                    $test_time=$col_data;
                    break;
                case "傳訊方式":
                    $transmit_method=$col_data;
                    break;
                case "設定時間":
                    ///
                    $a = explode("  ",$col_data);
                    $setting_weekdays = $a[0];
                    $setting_Sat = $a[1];
                    $setting_Sun = $a[2];
                    break;
                case "解除時間":
                    ///
                    $a = explode("  ",$col_data);
                    $remove_weekdays = $a[0];
                    $remove_Sat = $a[1];
                    $remove_Sun = $a[2];
                    break;
                case "MO":
                    $note=$col_data;
                    break;
                
            }
            
        }               
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');history.back();</script>";
    }
} else {
    echo "<script>alert('Sorry, there was an error uploading your file.');history.back();</script>";
}
echo "<script> alert('更新成功');location.href='customer.html';</script>";//
?>