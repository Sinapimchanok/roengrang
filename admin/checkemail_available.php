<?php 

    include_once('functions.php');

    $sql = new DB_con();

    // Getting post value
    if ($_POST['email'] == '') {
        echo "<span style='color: red;'>กรุณากรอกอีเมล</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }else{
        $email = $_POST['email'];

        $uemail = $sql->useremailavailable($email);

        $num = mysqli_num_rows($uemail);

        if ($num > 0) {
            echo "<span style='color: red;'>อีเมลนี้เชื่อมโยงกับบัญชีผู้ใช้อื่นแล้ว</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        } else {
            echo "<span style='color: green;'>อีเมลนี้สามารถใช้งานได้</span>";
            echo "<script>$('#submit').prop('disabled', false);</script>";
        }
    }

    

?>