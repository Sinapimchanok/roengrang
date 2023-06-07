<?php 

    session_start();
    include_once 'functions.php';

    $sql = new DB_con();

    $row = $sql->member($_POST['user_id']);
    $st=mysqli_fetch_array($row);

    if ($st['user_status'] == 1) {
        $st_full = '0';

    }else if ($st['user_status'] == 0){
        $st_full = '1';
    }

    $update = $sql->update_user_status($st_full,$_POST["user_id"]);
    
?>