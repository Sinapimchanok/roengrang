<?php 

    session_start();
    include_once 'functions.php';

    $sql = new DB_con();

    $update = $sql->update_request($_GET['user_id'],$_GET['status']);

    if ($update) {
        $_SESSION['statusMsg'] = "ตอบรับคำขอสำเร็จ";
        header("location: request.php");
    }else{
        $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
        header("location: request_detail.php");
    }
    
?>