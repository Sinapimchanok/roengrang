<?php 

session_start();
include_once 'functions.php';

$sql = new DB_con();

// File upload path
$targetDir = "img/";

if (isset($_POST['register'])) {
    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']); //แปลรหัสเป็น md5
    $user_fullname = $_POST['user_fullname'];
    $user_tel = $_POST['user_tel'];
    $user_address = $_POST['address'];
    $user_road = $_POST['road'];
    $user_soi = $_POST['soi'];
    $user_provinces = $_POST['provinces'];
    $user_district = $_POST['district'];
    $user_subdistrict = $_POST['subdistrict'];

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
                if($user_subdistrict=='191010'){
                    $insertuser = $sql->registrationLocal($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$fileName);
                    if ($insertuser) {
                        $_SESSION['statusMsg'] = "ลงทะเบียนสำเร็จกรุณาเข้าสู่ระบบ";
                        header("location: index.php"); 
                    }else {
                        $_SESSION['statusMsg'] = "ลงทะเบียนไม่สำเร็จกรุณาลงทะเบียนใหม่อีกครั้ง";
                        header("location: registers.php");
                    }
                }else{
                    $insertuser = $sql->registrationWorld($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$fileName);
                    if ($insertuser) {
                        $id = $sql->searchid($user_email);
                        $user=mysqli_fetch_array($id);
                        $sub = $sql->address($user_subdistrict);
                        $address=mysqli_fetch_array($sub);
                        $insertaddress = $sql->insertaddress($user['user_id'],$user['user_fullname'],$user['user_tel'],$user['user_address'],$user['user_road'],$user['user_soi'],$address['provinces_name'],$address['district_name'],$address['subdistrict_name'],$address['zip_code']);
                        if ($insertaddress) {
                            $_SESSION['statusMsg'] = "ลงทะเบียนสำเร็จกรุณาเข้าสู่ระบบ";
                            header("location: index.php"); 
                        }else {
                            $_SESSION['statusMsg'] = "ลงทะเบียนไม่สำเร็จกรุณาลงทะเบียนใหม่อีกครั้ง";
                            header("location: registers.php");
                        }
                    }
                } 
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: registers.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: registers.php");
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: registers.php");
    }
}

?>