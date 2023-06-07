<?php 
    include_once('functions.php'); 

    $sql = new DB_con();

    $query = $sql->province();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัคสมาชิกภายนอกชุมชน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel ="stylesheet" href="register.css">
</head>
<body>
    
    <div class="container">
        <form class="card" action="reg_upload.php" method="POST" enctype="multipart/form-data">
        <h1 ALIGN="center">สมัครสมาชิกภายนอกชุมชน</h1>
        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['statusMsg']; 
                        unset($_SESSION['statusMsg']);
                    ?>
                </div>
            <?php } ?>
        <hr>
            <div class="row mt-4">
                <div class="col-md-4">
                    อีเมล :
                    <input type="email" name="user_email" class="form-control mt-1 mb-1" required placeholder="E-mail"> 
                </div>
                <div class="col-md-4">
                    รหัสผ่าน:
                    <input type="password" name="user_password" class="form-control mt-1 mb-1" required placeholder="รหัสผ่าน"> 
                </div> 
                <div class="col-md-4">
                    ชื่อ-นามสกุล :
                    <input type="text" name="user_fullname" class="form-control mt-1 mb-1" required placeholder="ชื่อ-นามสกุล"> 
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    เบอร์โทรศัพท์ :
                    <input type="text" name="user_tel" class="form-control mt-1 mb-1"placeholder="เบอร์โทรศัพท์" minlength="10" maxlength="10"  required> 
                </div>
                <div class="col-md-4">
                    ที่อยู่ปัจจุบัน :
                    <input type="text" name="address" class="form-control mt-1 mb-1" required placeholder="บ้านเลขที่ และ หมู่"> 
                </div>
                <div class="col-md-3">
                    ถนน :
                    <input type="text" name="road" class="form-control mt-1 mb-1" required placeholder="ถนน"> 
                </div>
                <div class="col-md-3">
                    ตรอก/ซอย :
                    <input type="text" name="soi" class="form-control mt-1 mb-1" required placeholder="ตรอก/ซอย"> 
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    จังหวัด :
                    <select class="form-control mt-1 mb-1 " name="provinces" id="provinces" required>
                        <option value="19" >สระบุรี</option>
                    </select>
                </div>
                <div class="col-md-3">
                    อำเภอ/เขต :
                    <select class="form-control mt-1 mb-1" name="district" id="amphures" required>
                        <option value="1910" >เสาไห้</option>
                    </select>
                </div>
                <div class="col-md-3">
                    ตำบล/แขวง :
                    <select class="form-control mt-1 mb-1" name="subdistrict" id="districts" required>
                        <option value="191010" >เริงราง</option>
                    </select>
                </div>
                <div class="col-md-3">
                    รหัสไปรษณีย์ :
                    <select class="form-control mt-1 mb-1" name="zip_code" id="zip_code" required>
                        <option value="18160" >18160</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <center>
                <div class="col-md-4">
                    รูปโปรไฟล์:
                    <input type="file" name="file" class="form-control mt-1 mb-1" required accept="image/*"> 
                </div>
                </center>
            </div>
            <p class="mt-3" ALIGN="center" >
                <button type="submit" name="RegLog" class="btn btn-primary">สมัคสมาชิก</button>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php include('script.php');?>