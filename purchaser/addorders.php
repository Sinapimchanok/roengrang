<?php 

session_start();
include_once 'functions.php';

$sql = new DB_con();

// File upload path
$targetDir = "../img/";

if (isset($_POST['checkout'])) {
    $pro_id = $_POST['pro_id'];
    $user_id = $_SESSION['id']; //แปลรหัสเป็น md5
    $ord_name = $_POST['name'];
    $ord_amount = $_POST['quant'];
    $sumprice = $_POST['sum'];
    $sentprice = $_POST['sent'];
    $totalprice = $_POST['total'];
    $ord_tel = $_POST['tel'];
    $ord_address = $_POST['address'];
    $ord_road = $_POST['road'];
    $ord_soi = $_POST['soi'];
    $ord_province = $_POST['province'];
    $ord_district = $_POST['district'];
    $ord_subdistrict = $_POST['subdistrict'];
    $ord_postID = $_POST['zipcode'];
    $ord_location = $_POST['location'];
    $ord_note = $_POST['note'];

    $users = $sql->usershop($_SESSION['id']);
    $users=mysqli_fetch_array($users);

    $Pro = $sql->product($pro_id);
    $pro=mysqli_fetch_array($Pro);
    if ($users['shop_id'] == $pro['shop_id']){
        $_SESSION['statusMsg'] = "คุณไม่สามารถซื้อสินค้าภายในร้านของคุณได้";
        header("Location: checkout.php?pro_id=" . $pro_id);
    }else{
        if ($ord_amount > $pro['pro_amount']){
            $_SESSION['statusMsg'] = "จำนวนสินค้าในคลังคงเหลือ ".$pro['pro_amount']." ไม่เพียงพอต่อความต้องการของคุณ";
            header("Location: checkout.php?pro_id=" . $pro_id);
        }else {
            $pro_amount = $pro['pro_amount'] - $ord_amount;
            $pro_selled = $pro['pro_selled'] + $ord_amount;
            $insert = $sql->addorders($pro_id,$pro['shop_id'],$user_id,$ord_name,$ord_amount,$sumprice,$sentprice,$totalprice,$ord_tel,$ord_location,$ord_address,$ord_road,$ord_soi,$ord_province,$ord_district,$ord_subdistrict,$ord_postID,$ord_note,$payment,$pro_amount,$pro_selled);
        if ($insert) {
            
            $_SESSION['statusOrders'] = "ส่งคำสั่งซื้อแล้ว กรุณารอร้านค้าตอบรับออร์เดอร์";
                header("location: allorder.php"); 
            } else {
                $_SESSION['statusMsg'] = "ส่งคำสั่งซื้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
                header("Location: checkout.php?pro_id=" . $pro_id);
            }
        }
    }
         
}

?>