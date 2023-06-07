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
    if (isset($_POST['function']) && $_POST['function'] == 'update_order_status0') {
        $update = $sql->update_order_status0($_POST['id'], $_POST['order_status'],$_POST['sentprice']);
        
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

    if (isset($_POST['status2'])) {

        if (!empty($_FILES["file"]["name"])) {
            $tmp = $_FILES['file']['tmp_name'];
            $namefile = $_FILES['file']['name'];
            $fileBasame = basename($_FILES["file"]["name"]);
            $fileType = pathinfo($fileBasame, PATHINFO_EXTENSION);
            $fileName = md5(time().$namefile.$tmp).'.'.$fileType;
            $targetFilePath = $targetDir . $fileName;

            // Allow certain file formats
            $allowTypes = array('jpg', 'png');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $update = $sql->update_order_status2($_POST['id'], 3,$fileName);
                    if ($update) {
                        $order_status = $sql->checkst($_POST['id']);
                        $st = mysqli_fetch_array($order_status);
            
                        $num = mysqli_num_rows($order_status);
            
                        if ($num > 0) {
                            header("location: order_detail.php?id=".$_POST['id']); 
                        } else {
                            header("location: order_detail.php?id=".$_POST['id']); 
                        }
                    } else {
                        echo "Failed to update the order status.";
                    }
                } else{
                    echo "f";
                }
            }else{
                echo "y";
            }
        }else {
            echo "k";
        }
    }

    if (isset($_POST['status3'])) {
        if (!empty($_FILES["file1"]["name"]) && !empty($_FILES["file2"]["name"])) {
            $file1Tmp = $_FILES['file1']['tmp_name'];
            $file2Tmp = $_FILES['file2']['tmp_name'];
    
            $file1Name = $_FILES['file1']['name'];
            $file2Name = $_FILES['file2']['name'];
    
            $file1BaseName = basename($_FILES["file1"]["name"]);
            $file2BaseName = basename($_FILES["file2"]["name"]);
    
            $file1Type = pathinfo($file1BaseName, PATHINFO_EXTENSION);
            $file2Type = pathinfo($file2BaseName, PATHINFO_EXTENSION);
    
            $file1Name = md5(time() . $file1Name . $file1Tmp) . '.' . $file1Type;
            $file2Name = md5(time() . $file2Name . $file2Tmp) . '.' . $file2Type;
    
            $targetFilePath1 = $targetDir . $file1Name;
            $targetFilePath2 = $targetDir . $file2Name;
    
            // Allow certain file formats
            $allowTypes = array('jpg', 'png');
    
            $file1Uploaded = false;
            $file2Uploaded = false;
    
            if (in_array($file1Type, $allowTypes)) {
                if (move_uploaded_file($file1Tmp, $targetFilePath1)) {
                    $file1Uploaded = true;
                }
            }
    
            if (in_array($file2Type, $allowTypes)) {
                if (move_uploaded_file($file2Tmp, $targetFilePath2)) {
                    $file2Uploaded = true;
                }
            }
    
            if ($file1Uploaded && $file2Uploaded) {
                $update = $sql->update_order_status3($_POST['id'], 4, $file1Name, $file2Name);
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
    

?>