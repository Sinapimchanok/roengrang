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
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                            <a>ที่อยู่ในการจัดส่ง</a>
                            </div>
                            <div class="col" ALIGN="right">
                                <a>แก้ไข</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><a>naruedon boonthong</a><a style="margin: 10px;;">0653453456</a></p>
                        <p>ที่อยู่ในการจัดส่ง</p>
                    </div>
                </div>
                <div class="card rounded-0 mt-2">
                <div class="card-header">
                        <div class="row">
                            <div class="col">
                            <a>การจัดส่ง</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>ส่งภายในชุมชน
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">ส่งด้วยไปรษณีย์
                                            <label class="form-check-label" for="radio2"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><a>naruedon boonthong</a><a style="margin: 10px;;">0653453456</a></p>
                        <div class="row">
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
                    <a class="m-2 text-dark text-decoration-none">เลือกวิธีชำระเงิน</a>
                    
                        <div class="card m-1 rounded-2">
                            <div class="card-body">
                                <input type="radio" class="form-check-input" id="radio3" name="optradi" value="option1" checked> ชำระเงินปลายทาง
                                <label class="form-check-label" for="radio3"></label>
                            </div>
                        </div>
                        <div class="card m-1 rounded-2">
                            <div class="card-body">
                                <input type="radio" class="form-check-input" id="radio4" name="optradi" value="option2"> พร้อมเพย์
                                <label class="form-check-label" for="radio4"></label>
                            </div>
                        </div>
                        <h5 class="m-2">สรุปข้อมูลการสั้งซื้อ</h5>
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
                        <button type="button" class="btn btn-warning m-1 text-dark">สั่งซื้อ</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<?php 
    }
?>
    