<?php 

    session_start();
    include_once('functions.php');

    unset($_SESSION['shop_id']);
    echo "<script>window.location.href='/roengrang/purchaser/index.php'</script>";

?>