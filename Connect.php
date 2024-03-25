<?php
    $db_server = '127.0.0.1'; //伺服器(不用改)
    $db_name = 'test'; //資料庫(存放table的資料庫名稱)
    $db_user = 'root'; //使用者
    $db_passwd = ''; //密碼
    $sql = 'mysql:host=' . $db_server . ';dbname=' . $db_name;
    try {
        $sql_qry = new PDO($sql, $db_user, $db_passwd);
        #if ($sql_qry) echo "資料庫連線成功";
    } catch (PDOException $e) {
        die("資料庫連線失敗");
    }
?>