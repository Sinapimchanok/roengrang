<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    if ($_SESSION['user_role'] == "2") {
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
    
    <div class="container px-4 px-lg-5 my-5">
            <form class="card p-3" action="shop_upload.php" method="POST" enctype="multipart/form-data">
            <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['statusMsg']; 
                        unset($_SESSION['statusMsg']);
                    ?>
                </div>
            <?php } ?>
                <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-3 mt-4">สมัครร้านค้าชุมชนเริงราง</p>

                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <CENTER>
                        <div class="col-md-9">
                            <img class="card-img mb-5 mb-md-0" id="blah" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" height="380px" />
                        </div>
                        </CENTER>
                        <CENTER>
                        <div class="col-md-7">
                            <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                        </div>
                        </CENTER>
                    </div>
                    <div class="col-md-6">
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" id="shop_name" name="shop_name" type="text" placeholder="ชื่อร้านค้า" />
                        <label for="shop_name">ชื่อร้านค้า<span class="text-danger"> * ไม่ต้องเติมคำว่า "ร้าน" หรือ "ร้านค้า" นำหน้า</span></label>
                    </div>                    
                    
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="shop_detail" name="shop_detail" placeholder="รายละเอียด"></textarea>
                        <label for="shop_detail">รายละเอียดร้านค้า<span class="text-danger"> * ไม่เกิน ๕๐๐ ตัวอักษร</span></label>
                    </div>
                    
                    <p class="mt-3" ALIGN="center" >
                        <button type="submit" name="addShop" class="btn btn-primary">สมัครร้านค้า</button>
                    </p>
                </div>
            </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
</body>
</html>

<?php 
      }
    else{
    header("location: 401.php");}      
?>