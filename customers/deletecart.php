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
    echo "<span style='color: red;'>Username already associated with another account.</span>";
    echo "<script>$('#submit').prop('disabled', true);</script>";
} else {
    echo "<span style='color: green;'>Username available for registration.</span>";
    echo "<script>$('#submit').prop('disabled', false);</script>";
}

?>