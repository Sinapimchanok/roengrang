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
            <div class="col-8">
                <div class="card rounded-0">
                    <div class="card-body m-1 p-2" href="#">
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
                        <div class="row mt-1">
                            <div class="col-2">
                                <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                            </div>
                            <div class="col-5">
                                ชื่อรายละเอียด
                            </div>
                            <div class="col-3">
                                ราคา:300
                            </div>
                            <div class="col-2">
                                จำนวน:
                            </div>
                        </div>
                    </div>
                    <div class="card-body m-2 p-2" href="#">
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
                        <div class="row mt-1">
                            <div class="col-2">
                                <img src="img/<?=$procart['pro_img']?>.jpg" width="80px" height="90px" class="border" >
                            </div>
                            <div class="col-5">
                                ชื่อรายละเอียด
                            </div>
                            <div class="col-3">
                                ราคา:300
                            </div>
                            <div class="col-2">
                                จำนวน:
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card rounded-0">
                    <h5 class="m-3">สรุปข้อมูลการสั้งซื้อ</h5>
                    <div class="row m-2">
                        <div class="col-6 text-secondary">
                            <a >ราคา</a>
                        </div>
                        <div class="col-6 text-secondary" ALIGN="right">300</div>
                    </div>
                    <div class="row m-2">
                        <div class="col-6 text-secondary">
                            <a >จำนวน</a>
                        </div>
                        <div class="col-6 text-secondary" ALIGN="right">3</div>
                    </div>
                    <div class="row m-2">
                        <div class="col-6 text-secondary">
                            <a >ค่าส่ง</a>
                        </div>
                        <div class="col-6 text-secondary" ALIGN="right">3</div>
                    </div>
                    <hr>
                    <div class="row m-2">
                        <div class="col-6 text-dark">
                            <h6>รวมทั้งสิ้น</h6>
                        </div>
                        <div class="col-6 text-dark" ALIGN="right">
                            <h6>900 บาท</h6>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning m-1 text-dark">ดำเนินการชำระเงิน</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<?php 
    }
?>
    