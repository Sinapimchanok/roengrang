<?php
    include_once('functions.php'); 
        
    $sql = new DB_con();

    $targetDir = "../img/";

    if (isset($_POST['function']) && $_POST['function'] == 'update_order_status') {
        $update = $sql->update_order_status($_POST['id'], $_POST['order_status']);
        
        if ($update) {
            $order_status = $sql->checkst($_POST['id']);
            $st = mysqli_fetch_array($order_status);

            $num = mysqli_num_rows($order_status);

            if ($num > 0) {
                echo $st['order_status'];
            } else {
                echo "Failed to fetch the updated order status.";
            }
        } else {
            echo "Failed to update the order status.";
        }
    }
    if (isset($_POST['function']) && $_POST['function'] == 'update_order_status1') {
        $update = $sql->update_order_status1($_POST['id'], $_POST['order_status']);
        
        if ($update) {
            $order_status = $sql->checkst($_POST['id']);
            $st = mysqli_fetch_array($order_status);

            $num = mysqli_num_rows($order_status);

            if ($num > 0) {
                echo $st['order_status'];
            } else {
                echo "Failed to fetch the updated order status.";
            }
        } else {
            echo "Failed to update the order status.";
        }
    }
    if (isset($_POST['function']) && $_POST['function'] == 'update_order_status6') {
        $update = $sql->update_order_status6($_POST['id'], $_POST['order_status'],$_POST['cancleReason']);
        
        if ($update) {
            $order_status = $sql->checkst($_POST['id']);
            $st = mysqli_fetch_array($order_status);

            $num = mysqli_num_rows($order_status);

            if ($num > 0) {
                echo $st['order_status'];
            } else {
                echo "Failed to fetch the updated order status.";
            }
        } else {
            echo "Failed to update the order status.";
        }
    }
    if (isset($_POST['receive_order'])) {
        if (!empty($_FILES["receive_img"]["name"]) && !empty($_FILES["payment_img"]["name"])) {
            $receive_imgTmp = $_FILES['receive_img']['tmp_name'];
            $payment_imgTmp = $_FILES['payment_img']['tmp_name'];
    
            $receive_imgName = $_FILES['receive_img']['name'];
            $payment_imgName = $_FILES['payment_img']['name'];
    
            $receive_imgBaseName = basename($_FILES["receive_img"]["name"]);
            $payment_imgBaseName = basename($_FILES["payment_img"]["name"]);
    
            $receive_imgType = pathinfo($receive_imgBaseName, PATHINFO_EXTENSION);
            $payment_imgType = pathinfo($payment_imgBaseName, PATHINFO_EXTENSION);
    
            $receive_imgName = md5(time() . $receive_imgName . $receive_imgTmp) . '.' . $receive_imgType;
            $payment_imgName = md5(time() . $payment_imgName . $payment_imgTmp) . '.' . $payment_imgType;
    
            $targetFilePath1 = $targetDir . $receive_imgName;
            $targetFilePath2 = $targetDir . $payment_imgName;
    
            // Allow certain file formats
            $allowTypes = array('jpg', 'png');
    
            $receive_imgUploaded = false;
            $payment_imgUploaded = false;
    
            if (in_array($receive_imgType, $allowTypes)) {
                if (move_uploaded_file($receive_imgTmp, $targetFilePath1)) {
                    $receive_imgUploaded = true;
                }
            }
    
            if (in_array($payment_imgType, $allowTypes)) {
                if (move_uploaded_file($payment_imgTmp, $targetFilePath2)) {
                    $payment_imgUploaded = true;
                }
            }
    
            if ($receive_imgUploaded && $payment_imgUploaded) {
                $update = $sql->update_order_status4($_POST['id'], 5, $receive_imgName, $payment_imgName);
                if ($update) {
                    $order_status = $sql->checkst($_POST['id']);
                    $st = mysqli_fetch_array($order_status);
    
                    $num = mysqli_num_rows($order_status);
    
                    if ($num > 0) {
                        header("location: order_detail.php?id=" . $_POST['id']);
                    } else {
                        header("location: order_detail.php?id=" . $_POST['id']);
                    }
                } else {
                    echo "Failed to update the order status.";
                }
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "Please upload both files.";
        }
    }
    if (isset($_POST['radios']) && isset($_POST['review'])) {
        $point = floatval($_POST['radios']);
        $review = $_POST['review'];
        
        $Allord = $sql->order($_POST['id']);
        $allord=mysqli_fetch_array($Allord);
        
        $allordpro = $sql->orderproduct($allord['pro_id']);
        $num = mysqli_num_rows($allordpro);

        if($num>10){
            $points = $sql->point($allord['pro_id']);
            $points = $points['points'];
        }else{
            $product = $sql->product($allord['pro_id']);
            $Product=mysqli_fetch_array($product);

            $points = ($point+($Product['pro_point'] * 10 ))/11 ;
        }
        
        
        $update = $sql->review($_POST['id'], $points,$_POST['review'],$allord['pro_id']);

        header("location: order_detail.php?id=" . $_POST['id']);
    } 
    if (isset($_POST['reportproduct'])) {
        // Form has been submitted
        // You can access the form field values using $_POST['fieldname']
        $topic = $_POST['topic'];
        $detail = $_POST['detail'];
        $product = $sql->reportproduct($allord['pro_id']);
  
    }
    

?>