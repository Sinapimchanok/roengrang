<?php 

include_once 'functions.php';

$sql = new DB_con();

    

?>
<?php 

include_once('functions.php');

$sql = new DB_con();

$cart_id = $_GET['cart_id'];

$delcart = $sql->deletecart($cart_id);

if ($delcart) {
    $_SESSION['statusMsg'] = "ลบสมาชิกสำเร็จ";
    header("location: cart.php");
} else {
    $_SESSION['statusMsg'] = "มีบางอย่างผิดพลาด";
    header("location: cart.php");
}

?>