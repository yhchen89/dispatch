<?php
    session_start();
    if(isset($_SESSION['login_ID'])){
        echo json_encode(4,JSON_UNESCAPED_UNICODE);
    }
    else
        echo json_encode(5,JSON_UNESCAPED_UNICODE);
?>