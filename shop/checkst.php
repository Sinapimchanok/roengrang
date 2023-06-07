<?php 

    include_once('functions.php');

    $sql = new DB_con();

    // Getting post value
    if ($_POST['id'] == '') {
        echo "<script>alert('fail');</script>";
    }else{
        $id = $_POST['id'];

        $order_status = $sql->checkst($id);
        $st=mysqli_fetch_array($order_status);

        $num = mysqli_num_rows($order_status);

        if ($num > 0) {
            echo $st['order_status'];
        } else {
            echo "<script>alert('fff');</script>";
        }
    }

    

?>