<?php
  session_start();
  include_once('functions.php'); 
    
  $sql = new DB_con();


  if (isset($_POST['function']) && $_POST['function'] == 'addlike') {
    $product_id = $_POST['product_id'];
    if ($product_id) {
      $insert = $sql->addlike($product_id,$_SESSION['id']);
      if ($insert) {
        echo $product_id ;
      }else {
        echo "error";
    }
    }
  }

  if (isset($_POST['function']) && $_POST['function'] == 'unlike') {
    $product_id = $_POST['product_id'];

    if ($product_id) {
      $delete = $sql->unlike($product_id,$_SESSION['id']);
      if ($delete) {
        echo $product_id ;
      }else {
        echo "error";
    }
    }
  }

  if (isset($_POST['function']) && $_POST['function'] == 'addcart') {
    $product_id = $_POST['product_id'];
    $product_amount = intval($_POST['product_amount']);

    $users = $sql->usershop($_SESSION['id']);
    $users=mysqli_fetch_array($users);

    $Pro = $sql->product($product_id);
    $pro=mysqli_fetch_array($Pro);

    
    if ($users['shop_id'] == $pro['shop_id']){
      echo "shop";
    }else{
      if($product_amount>$pro['pro_amount']){
        echo "amount";
      }else{
        $wherecart = $sql->wherecart($product_id, $_SESSION['id']);
        $wherecart = mysqli_fetch_array($wherecart);
        if ($wherecart == null) {
            $addcart = $sql->addcart($product_id, $_SESSION['id'], $product_amount);
            $rs = $sql->rowsum($_SESSION['id']);
            $RS=mysqli_fetch_array($rs);
            if ($addcart) {
              echo $RS['count'];
            }
        } else {
            $product_amount += $wherecart['amount'];
            $updatecart = $sql->updatecart($product_id, $_SESSION['id'], $product_amount);
            $rs = $sql->rowsum($_SESSION['id']);
            $RS=mysqli_fetch_array($rs);
            if ($updatecart) {
              echo $RS['count'];
            }
        }
      }
    }
}


?>