<?php

session_start();
include_once 'functions.php';

$sql = new DB_con();

    if($_GET['what']=='user'){
        $shop = $sql->whoshop($_GET['user_id']);
        $shop_id=mysqli_fetch_array($shop);

        $pro = $sql->shop_products($shop_id['shop_id']);
        while($Pro=mysqli_fetch_array($pro)){
            $delete = $sql->delete_products($Pro['pro_id']);
        }
        $delete = $sql->delete_shop($shop_id['shop_id']);
        $delete = $sql->delete_user($_GET['user_id']);
        if ($delete) {
            $_SESSION['statusMsg'] = "ลบสมาชิกสำเร็จ";
            header("location: member.php");
        }else{
            $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
            header("location: member.php");
        }

    }else if($_GET['what']=='shop'){
        $pro = $sql->shop_products($_GET['shop_id']);
        while($Pro=mysqli_fetch_array($pro)){
            $delete = $sql->delete_products($Pro['pro_id']);
        }
        $delete = $sql->delete_shop($_GET['shop_id']);
        if ($delete) {
            $_SESSION['statusMsg'] = "ลบสมาชิกสำเร็จ";
            header("location: shop.php");
        }else{
            $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
            header("location: shop.php");
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

    else if($_GET['what']=='catagory'){
        $pro = $sql->cat_products($_GET['cat_id']);
        while($Pro=mysqli_fetch_array($pro)){
            $delete = $sql->delete_products($Pro['pro_id']);
        }
        $delete = $sql->delete_catagory($_GET['cat_id']);
        if ($delete) {
            $_SESSION['statusMsg'] = "ลบหมวดหมู่สำเร็จ";
            header("location: catagory.php");
        }else{
            $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
            header("location: catagory.php");
        }
    }
    
?>
    