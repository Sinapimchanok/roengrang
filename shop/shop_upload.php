<?php 

    session_start();
    include_once 'functions.php';

    $sql = new DB_con();

    // File upload path
    $targetDir = "../img/";

    if (isset($_POST['addShop'])) {
        $shop_name = $_POST['shop_name'];
        $shop_detail = $_POST['shop_detail'];
        

        if (!empty($_FILES["file"]["name"])) {
            $tmp = $_FILES['file']['tmp_name'];
            $namefile = $_FILES['file']['name'];
            $fileBasame = basename($_FILES["file"]["name"]);
            $fileType = pathinfo($fileBasame, PATHINFO_EXTENSION);
            $fileName = md5(time().$namefile.$tmp).'.'.$fileType;
            $targetFilePath = $targetDir . $fileName;

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $insert = $sql->insertShop($_SESSION['id'], $shop_name, $shop_detail, $fileName);
                    if ($insert) {
                        $shop = $sql->usershop($_SESSION['id']);
                        $num = mysqli_fetch_array($shop);
                        if ($num > 0) {
                            $_SESSION['shop_id'] = $num['shop_id'];
                            header("location: index.php"); 
                        }else{
                            $_SESSION['statusMsg'] = "เพิ่มร้านค้าสำเร็จ";
                            header("location: index.php"); 
                        }
                    } else {
                        $_SESSION['statusMsg'] = "ผิดพลาดกรุณาลองใหม่อีครั้ง";
                        header("location: registershop.php");
                    }
                } 
            }else {
                $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
                header("location: registershop.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Please select a file to upload.";
            header("location: registershop.php");
        }
    }

?>