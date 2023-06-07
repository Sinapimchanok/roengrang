<?php 

    session_start();
    include_once 'functions.php';

    $sql = new DB_con();

    $row = $sql->products($_POST['pro_id']);
    $st=mysqli_fetch_array($row);

    if ($st['pro_ban'] == 1) {
        $st_full = '0';

    }else if ($st['pro_ban'] == 0){
        $st_full = '1';
    }

    $update = $sql->update_pro_status($st_full,$_POST["pro_id"]);
    
?>