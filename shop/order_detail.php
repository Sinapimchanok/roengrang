<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    if ($_SESSION['user_role'] == "2") {
        if ($_SESSION['shop_id']){
            $user_shop = $sql->shopavailable($_SESSION['shop_id']);
            $User_shop=mysqli_fetch_array($user_shop);
            if ($_SESSION['id'] == $User_shop['user_id'] ) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ร้านค้าชุมชนเริงราง</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>

            /* Style the tab */
            .tab {
            overflow: hidden;
            margin : 14px 16px;
            border: 1px solid #ccc;
            border-radius: 10px ;
            background-color: #f1f1f1;
            }

            /* Style the buttons inside the tab */
            .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
            background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
            background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
            display: none;
            padding: 6px 12px;
            background-color: #fff;
            /* border: 1px solid #ccc; */
            border: none;
            border-top: none;
            }

            .modal {
            display: none; /* Hide the modal by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay background color */
            }

            .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            text-align: center; /* Center the content horizontally */
            position: relative; /* Add relative positioning */
            }

            .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute; /* Add absolute positioning */
            top: 10px; /* Position from the top */
            right: 10px; /* Position from the right */
            }

            .close:hover,
            .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-light">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" style="color:black;" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-1" style="color:black;" href="index.php">
                <img src="\roengrang\img/logo1.png" alt="logo" height="36"> ร้านค้าชุมชนเริงราง
            </a>
            
            <!-- Navbar Message-->
            <button class="d-none d-md-inline-block btn btn-link ms-auto me-3 me-lg-0 text-decoration-none" style="color:black;" id="sidebarToggle">
            <i class="fa-brands fa-shopify"></i> 
            <a class="text-decoration-none" style="color:black;" href="goCustomer.php">
                โหมดช็อปปิ้ง
            </a>
            </button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color:black;" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?=$_SESSION['fname']?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#!">ตั้งค่าบัญชี</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="/roengrang/logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ภาพรวมของระบบ
                            </a>
                            <a class="nav-link" href="order.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                คำสั่งซื้อ
                            </a>
                            <a class="nav-link" href="review.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                รีวิวคำสั่งซื้อ และร้านค้า
                            </a>
                            <a class="nav-link" href="report.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-coins"></i></div>
                                การเงิน
                            </a>
                            <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#ProductLayout" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                สินค้า
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ProductLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="allproduct.php">จัดการสินค้า</a>
                                    <a class="nav-link" href="addproduct.php">เพิ่มสินค้า</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer text-center">
                        ร้าน <?=$_SESSION['shop_name']?>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">

                <main>

                    <div class="container px-4 px-lg-5 mt-5">
                    <?php
                        $allord = $sql->order($_GET['id'],$_SESSION['shop_id']);
                        $Allord=mysqli_fetch_array($allord);
                    ?>
                    <h3 class="mt-4">คำสั่งซื้อที่ #<?=$Allord['id']?></h3>
                        <hr>
                        <div class="row">
                            <div class="col-9">
                                <div class="card"> 
                                    <div class="card-body">
                                        <h5 class="mb-4">รายการสินค้า</h5> 
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-4"><img src="\roengrang\img/<?=$Allord['pro_img']?>" style="width: 96px;hieght: 96px;"></div>
                                                        <div class="col-6"><?=$Allord['pro_name']?></div>
                                                    </div>
                                                </div>
                                                <div class="col-3"><?=$Allord['pro_price']?> บาท</div>
                                                <div class="col-3">จำนวน : <?=$Allord['ord_amount']?></div>
                                            </div>
                                            <hr>

                                        <h5 class="mb-4">ยอดรวมการสั่งซื้อ</h5>    
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-4"> 
                                                        ยอดรวม : <?=$Allord['sum_price']?> บาท
                                                    </div>
                                                    <div class="col-4">
                                                        ค่าจัดส่ง : <?=$Allord['sent_price']?> บาท
                                                    </div>
                                                    <div class="col-4">
                                                        ยอดรวมสุทธิ : <?=$Allord['total_price']?> บาท
                                                    </div>
                                                </div>
                                            </div>
                                        </div><hr>

                                        <h5 class="mb-4">ที่อยู่ในการจัดส่ง</h5>    
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-3"><?=$Allord['ord_name']?></div>
                                                    <div class="col-3">เบอร์โทรศัพท์ : <?=$Allord['ord_tel']?></div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-3"> 
                                                        ที่อยู่ : <?=$Allord['ord_address']?>
                                                    </div>
                                                    <div class="col-3">
                                                        ถนน : <?=$Allord['ord_road']?>
                                                    </div>
                                                    <div class="col-3">
                                                        ซอย : <?=$Allord['ord_soi']?>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        ตำบล/แขวง : <?=$Allord['ord_subdistrict']?>
                                                    </div>
                                                    <div class="col-3">
                                                        อำเภอ/เขต : <?=$Allord['ord_district']?>
                                                    </div>
                                                    <div class="col-3">
                                                        จังหวัด : <?=$Allord['ord_province']?>
                                                    </div>
                                                    <div class="col-3">
                                                        รหัสไปรษณีย์ : <?=$Allord['ord_postID']?>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        ตำแหน่งที่จัดส่ง : <a href="<?=$Allord['ord_location']?>" target="_blank"><?=$Allord['ord_location']?></a>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        หมายเหตุ : <?=$Allord['ord_note']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5>สถานะคำสั่งซื้อ</h5><hr>
                                        <div class="row justify-content-center">
                                            <p id="status">
                                                <?php
                                                switch ($Allord['order_status']) {
                                                    case 0:
                                                        echo "คำสั่งซื้อใหม่ กรุณาตอบรับคำสั่งซื้อ";
                                                        break;
                                                    case 1:
                                                        echo "ตอบรับคำสั่งซื้อแล้ว<br>กรุณาจัดเตรียมสินค้าเพื่อจัดส่ง";
                                                        break;
                                                    case 2:
                                                        echo "อยู่ระหว่างเตรียมสินค้า<br>กรุณาจัดส่งสินค้าเมื่อเสร็จสิ้น";
                                                        break;
                                                    case 3:
                                                        echo "อยู่ระหว่างขนส่งสินค้า";
                                                        break;
                                                    case 4:
                                                        echo "จัดส่งสินค้าสำเร็จแล้ว";
                                                        break;
                                                    case 5:
                                                        echo "คำสั่งซื้อเสร็จสิ้น";
                                                        break;
                                                    case 6:
                                                        echo "คำสั่งซื้อถูกยกเลิก";
                                                        break;
                                                }
                                                ?>
                                            </p>
                                            <input hidden type="number" id="st" value="<?=$Allord['order_status']?>">
                                            <input hidden type="number" id="id" value="<?=$Allord['id']?>">
                                            <input hidden type="text" id="Reason" value="<?=$Allord['cancleReason']?>">
                                        </div>
                                        <div class="row mt-3 justify-content-center" >
                                            <div id="oparetion"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cancel Modal -->
                    <div id="cancleModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h3 class="modal-title">เหตุผลในการยกเลิกคำสั่งซื้อ</h3>
                            <div class="row justify-content-center mt-3 mb-3">
                                <textarea name="cancleReason" id="cancleReason" cols="30" rows="10" style="width: 75%;"></textarea>
                            </div>
                            <div hidden><button type="button" class="btn" id="cancleModalCloseBtn">Close</button></div>
                            <div><button id="st6" type="button" class="btn btn-danger">ยกเลิกคำสั่งซื้อ</button></div>
                        </div>
                    </div>

                    <!-- Confirmation Modal -->
                    <div id="confermModal" class="modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                        <h5 class="modal-title">Confirmation Modal</h5>
                        <p>Confirmation modal content goes here...</p>
                        <button type="button" class="btn" id="confermModalCloseBtn">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>

                    <div id="sentPriceModal" class="modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <h3 class="modal-title">กรุณาระบุค่าจัดส่งสินค่า</h3>
                            <div class="row justify-content-center mt-3 mb-3">
                                <div>ค่าจัดส่ง :</div>
                                <div><input type="number" class="mt-2" id="sentprice" name="sentprice" value=""></div>
                            </div>
                            <p class="text-danger">ถ้าหากยืนยันตอบรับคำสั่งซื้อแล้วจะไม่สามารถเปลี่ยนค่าส่งได้อีก</p>
                            <div hidden><button type="button" class="btn" id="sentPriceModalCloseBtn">Close</button></div>
                            <div><button id="st0" type="button" class="btn btn-primary">ยืนยันตอบรับคำสั่งซื้อ</button></div>
                        </div>
                    </div>

                    <div id="shipModal" class="modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <form action="update.php" method="POST" enctype="multipart/form-data">
                                <input hidden type="number" name="order_status" value="<?=$Allord['order_status']?>">
                                <input hidden type="number" name="id" value="<?=$Allord['id']?>">
                                <h3 class="modal-title">อัพโหลดรูปถ่ายหลักฐานการส่งสินค้า</h3>
                                <div class="row justify-content-center mt-3 mb-3">
                                    <div><input type="file" class="mt-2" id="file" name="file"></div>
                                </div>
                                <div hidden><button type="button" class="btn" id="shipModalCloseBtn">Close</button></div>
                                <div><button type="submit" name="status2" class="btn btn-primary">ยืนยันตอบรับคำสั่งซื้อ</button></div>
                            </form>
                        </div>
                    </div>

                    <div id="sentModal" class="modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <form action="update.php" method="POST" enctype="multipart/form-data">
                                <input hidden type="number" name="order_status" value="<?=$Allord['order_status']?>">
                                <input hidden type="number" name="id" value="<?=$Allord['id']?>">
                                <h3 class="modal-title">อัพโหลดรูปถ่ายหลักฐานการส่งสินค้า</h3>
                                <div class="row justify-content-center mt-3 mb-3">
                                    <div><input type="file" class="mt-2" id="file1" name="file1"></div>
                                </div>
                                <h3 class="modal-title">อัพโหลดรูปถ่ายหลักฐานการรับเงิน</h3>
                                <div class="row justify-content-center mt-3 mb-3">
                                    <div><input type="file" class="mt-2" id="file2" name="file2"></div>
                                </div>
                                <div hidden><button type="button" class="btn" id="sentModalCloseBtn">Close</button></div>
                                <div><button type="submit" name="status3" class="btn btn-primary">ยืนยันตอบรับคำสั่งซื้อ</button></div>
                            </form>
                        </div>
                    </div>

                </main>

                
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </body>
</html>
<?php include('script.php');?>
<?php 
      }
            else{
            header("location: 401.php");}
        }
        else{
        header("location: 401.php");}
    }
    else{
    header("location: 401.php");}      
?>