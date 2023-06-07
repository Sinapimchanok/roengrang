<?php

session_start();
include_once 'functions.php';

$sql = new DB_con();

    if($_GET['what']=='shop'){
        $pro = $sql->shop_products($_GET['shop_id']);
        while($Pro=mysqli_fetch_array($pro)){
            $delete = $sql->delete_products($Pro['pro_id']);
        }
        $delete = $sql->delete_shop($_GET['shop_id']);
        if ($delete) {
            $_SESSION['statusMsg'] = "ลบร้านค้าสำเร็จ";
            header("location: shop.php");
        }else{
            $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
            header("location: index.php");
        }

    }else if($_GET['what']=='products'){
        $delete = $sql->delete_products($_GET['pro_id']);
        if ($delete) {
            $_SESSION['statusMsg'] = "ลบสินค้าสำเร็จ";
            header("location: allproduct.php");
        }else{
            $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
            header("location: allproduct.php");
        }
    }
    
?>
    