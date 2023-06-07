<?php 

    session_start();
    include_once 'functions.php';

    $sql = new DB_con();

    $row = $sql->shop($_POST['shop_id']);
    $st=mysqli_fetch_array($row);

    if ($st['shop_status'] == 1) {
        $st_full = '0';

    }else if ($st['shop_status'] == 0){
        $st_full = '1';
    }

    $update = $sql->update_shop_status($st_full,$_POST["shop_id"]);
    
?>