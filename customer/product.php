<?php 
    session_start();
    include_once('functions.php'); 
    include_once('layout.php'); 
    include_once('include/nav.php'); 

    if ($_SESSION['id'] == "") {
        header("location: index.php");
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านค้าชุมชนเริงราง</title>
</head>
<body>

    <div class="container px-4 px-lg-5 mt-4">
        <div class="row">

            <?php
                $pro_id=$_GET['pro_id'];

                $sql = new DB_con();

                $product = $sql->product($pro_id);
                $pro=mysqli_fetch_array($product);
            ?>

            <div class="col-4">
                <img class="card-img-top mb-5 mb-md-0" src="\roengrang\img/<?=$pro['pro_img']?>.jpg" height="370px"/>
            </div>
            <div class="col-8">
                <h2>
                    <?=$pro['pro_name']?>
                </h2>
                <div class="row">
                    <div class="col-2">
                        คะแนน
                    </div>
                    <div class="col-2">
                        <a>ขายแล้ว</a>
                    </div>
                    <div class="col-2">
                        <a>ถูกใจแล้ว</a>
                    </div>
                </div>
                <a>
                    ร้าน<?=$pro['shop_name']?>
                </a>
                <p height="50px">
                    <?=$pro['pro_detail']?>
                </p>
                <div class="fs-5 mb-5">
                    <!-- <span class="text-decoration-line-through">$45.00</span> -->
                    <span><?=$pro['pro_price']?> </span>บาท
                </div>
                มีสินค้าทั้งหมด  <?=$pro['pro_amount']?>
                <hr>
                <p>
                จำนวน 
                    <a class="btn btn-outline-dark flex-shrink-0" style="width: 40px;" type="button">-</a>
                    <a class="btn btn-outline-dark" style="width: 70px;" type="button">10</a>
                    <a class="btn btn-outline-dark flex-shrink-0" style="width: 40px;" type="button">+</a>
                </p>
                <button class="btn btn-primary flex-shrink-0" type="button">
                    ซื้อเลย
                </button>
                <button class="btn btn-outline-primary flex-shrink-0" type="button">
                    ใส่ตะกร้า
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-8">
                <h3>ความคิดเห็น</h3>
                <hr>
                <div class="card mb-5 p-2">
                    

                        <div class="p-2">
                            <div class="card-header">
                                <h5><?=$com['fullname']?></h5>
                            </div>
                            <div class="card-body">
                                <a><?=$com['com_detail']?></a>
                            </div>
                        </div>
                        
                    
                </div>
                <p ALIGN="center">
                    <a>ดูเพิ่มเติม</a>
                </p>
            </div>
            <div class="col-4">
                <div class="card p-2">
                    <a>จัดจำหน่ายโดย</a>
                    <div class="mt-1">
                        <h3>ชื่อร้านค้า</h3>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a>คะแนน</a>
                        </div>
                        <div class="col-6">
                            <a>ขายแล้ว</a>
                        </div>
                    </div>
                    <button class="btn btn-warning mt-1"><a class="text-light" href="">ไปที่ร้านค้า</a></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php 
    }
?>
    