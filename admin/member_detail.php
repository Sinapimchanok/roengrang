<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    if ($_SESSION['user_role'] != "1") {
        header("location: 401.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script type='text/javascript'>
        function preview_image(event) 
        {
             var reader = new FileReader();
             reader.onload = function()
             {
                  var output = document.getElementById('showimg');
                  output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);
        }
        </script>
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
        </style>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            
            <a class="navbar-brand ps-1" href="index.php">
                <img src="\roengrang\img/logo1.png" alt="logo" height="36"> ร้านค้าชุมชนเริงราง
            </a>
            <!-- Navbar Message-->
            <button class="d-none d-md-inline-block btn btn-link ms-auto me-3 me-lg-0" id="sidebarToggle" href="#"><i class="fas fa-message"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?=$_SESSION['fname']?></a>
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
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ภาพรวมของระบบ
                            </a>
                            <a class="nav-link" href="request.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                คำร้องขอสมัครสมาชิก
                            </a>
                            
                            <!-- <div class="sb-sidenav-menu-heading"></div> -->

                            <a class="nav-link" href="shop.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ร้านค้า
                            </a>

                            <a class="nav-link" href="allproduct.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                สินค้า
                            </a>

                            <a class="nav-link" href="member.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                สมาชิก
                            </a>

                            <a class="nav-link collapsed"  data-bs-toggle="collapse" data-bs-target="#problem" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                รายงานปัญหา
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="problem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="report_shop.php">รายงานปัญหาร้านค้า</a>
                                    <a class="nav-link" href="report_pro.php">รายงานปัญหาสินค้า</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container px-4 px-lg-5 mt-5">
                    <h1 class="mt-4">ข้อมูลสมาชิก</h1>
                        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['statusMsg']; 
                                    unset($_SESSION['statusMsg']);
                                ?>
                            </div>
                        <?php } ?>
                        <hr>
                        <div class="card">
                                <div class="card-body">
                                <?php
                                    $Mem = $sql->requestdetail($_GET['user_id']);
                                    $mem=mysqli_fetch_array($Mem);
                                    $address = $sql->useraddress($_GET['user_id']);
                                    $Address=mysqli_fetch_array($address);
                                ?>
                                <br>
                                    <div class="row">
                                        <div class="col-3">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <center>
                                                    <img src="\roengrang\img/<?=$mem['user_img']?>" alt="avatar" width="200" height="200">
                                                </center>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <label class="form-label">อีเมล :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_email']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                <label class="form-label">ชื่อ-นามสกุล :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_fullname']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">เบอร์โทรศัพท์ :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_tel']?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <label class="form-label">ที่อยู่(บ้านเลขที่ และ หมู่) :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_address']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">ถนน :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_road']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">ตรอก/ซอย :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_soi']?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-3">
                                                    <label for="provinces" class="form-label">จังหวัด :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['user_province']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="district" class="form-label">อำเภอ/เขต :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['user_district']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="subdistrict" class="form-label">ตำบล/แขวง :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['user_subdistrict']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="zip_code" class="form-label">รหัสไปรษณีย์ :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['user_zipcode']?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-3">
                                                    <label for="user_role" class="form-label">ประเภทสมาชิก :</label>
                                                    <div>
                                                        <label class="form-label">
                                                            <?php
                                                                switch ($mem['user_role']) {
                                                                case 1:
                                                                    echo "ผู้ดูแลระบบ";
                                                                    break;
                                                                case 2:
                                                                    echo "สมาชิกภายในชุมชน";
                                                                    break;
                                                                case 3:
                                                                    echo "สมาชิกภายนอกชุมชน";
                                                                    break;
                                                                default:
                                                                    echo "กำลังร้องขอ";
                                                                }
                                                            ?>    
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="user_status" class="form-label">สถานะ :</label>
                                                    <div>
                                                        <label class="form-label">
                                                            <?php
                                                                switch ($mem['user_status']) {
                                                                case 0:
                                                                    echo "ระงับ";
                                                                    break;
                                                                case 1:
                                                                    echo "ปกติ";
                                                                    break;
                                                                }
                                                            ?>    
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="regDate" class="form-label">วันที่สมัครสมาชิก :</label>
                                                    <div>
                                                        <label class="form-label"><?=$mem['user_regDate']?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                                if($mem['user_role']==2){
                                                    $Shop = $sql->whoshop($_GET['user_id']);
                                                    $shop=mysqli_fetch_array($Shop);
                                            ?>
                                                <div class="row mt-4">
                                                    <div class="col-md-3">
                                                        <label class="form-label">ชื่อร้านค้า :</label>
                                                        <div>
                                                            <label class="form-label"><?=$shop['shop_name']?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">สถานะร้านค้า :</label>
                                                        <div>
                                                            <label class="form-label">
                                                                <?php
                                                                    switch ($shop['shop_status']) {
                                                                    case 0:
                                                                        echo "ระงับ";
                                                                        break;
                                                                    case 1:
                                                                        echo "ปกติ";
                                                                        break;
                                                                    }
                                                                ?>    
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">คะแนน :</label>
                                                        <div>
                                                            <label class="form-label"><?=$shop['shop_point']?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div>
                                                            <a href="shop_detail.php?shop_id=<?=$shop['shop_id']?>" class="form-label text-decoration-none">ดูข้อมูลร้านค้า</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <br>
                                
                                <p align ="right">
                                    <a class="text-decoration-none" href="editmember.php?user_id=<?=$mem['user_id']?>">
                                        <button type="button" style="width:130px;" class="btn btn-primary">แก้ไขข้อมูล</button>
                                    </a>
                                    <input type=button class="btn btn-outline-danger text-decoration-none" onClick='window.history.back()' value='ย้อนกลับ'>
                                </p>

                                </div>
                           
                        </div>
                                
                    </div>
                </main>

               
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js.js" type="text/javascript"></script>
    </body>
</html>

<?php } ?>
