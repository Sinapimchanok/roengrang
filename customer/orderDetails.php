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
        <h2>รายละเอียดคำสั่งซื้อ</h2>
        <div class="card rounded-0">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        ชื่อร้านค้า
                    </div>
                    <div class="col-3" ALIGN="right">
                        สถานะ
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                    </div>
                    <div class="col-4">
                        ชื่อรายละเอียด
                    </div>
                    <div class="col-2">
                        ราคา:300
                    </div>
                    <div class="col-2">
                        จำนวน:
                    </div>
                    <div class="col-2">
                        <a class="text-decoration-none" href="">เขียนรีวิว</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-6">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="text-dark"><h6>คำสั่งซื้อ 3424356886124</h6></div>
                        <div class="text-secondary">สั่งซื้อเมื่อ 12/12/12 12:12:12</div>
                    </div>
                </div>

                <div class="card rounded-0 mt-2">
                    <div class="card-body">
                        <div class="text-dark">naruedon boonthong</div>
                        <div class="text-secondary">รายละเอียดที่อยู่</div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card rounded-0 ">
                    <div class="card-body">
                        <div class="text-dark">
                            <h5>สรุปยอดรวมทั้งสิน</h5>
                        </div>
                        <div class="row">
                            <div class="col-6 text-body">ยอดรวมส่วนนี้ ( 1 สินค้า )</div>
                            <div class="col-6 text-body" ALIGN="right">300</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-body">ค่าจัดส่ง</div>
                            <div class="col-6 text-body" ALIGN="right">30</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 text-body">ยอดรวมทั้งสิน</div>
                            <div class="col-6 text-body" ALIGN="right">30</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-body">ขำระเงินโดย</div>
                            <div class="col-6 text-body" ALIGN="right">เก็บเงินปลายทาง</div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>


<?php 
    }
?>
    