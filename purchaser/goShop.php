<?php 

    session_start();
    include_once('functions.php');

    $usernamecheck = new DB_con();

    $sql = $usernamecheck->usershop($_SESSION['id']);
    $num = mysqli_fetch_array($sql);
    $_SESSION['shop_id'] = $num['shop_id'];
    $_SESSION['shop_name'] = $num['shop_name'];
    if ($num) {
        echo "<script>window.location.href='/roengrang/shop/index.php'</script>";
    }else{
        echo "<script>window.location.href='/roengrang/shop/registers_shop.php'</script>";
    }

?>