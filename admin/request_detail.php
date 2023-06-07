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
                    <h1 class="mt-4">คำร้องขอสมัครสมาชิก</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">สำหรับเฉพาะผู้ที่อาศัยในชุมชนเริงรางเท่านั้น กรุณาตรวจสอบข้อมูลของผู้สมัครว่าเป็นจริง และอาศัยอยู่ในชุมชนหรือไม่</li>
                        </ol>
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
                                    $address = $sql->address($mem['user_subdistrict']);
                                    $Address=mysqli_fetch_array($address);
                                ?>
                                <br>
                                    <div class="row">
                                        <div class="col-4">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <center>
                                                    <img src="\roengrang\img/<?=$mem['user_img']?>" alt="avatar" width="300" height="300">
                                                </center>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-8">
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
                                            <div class="row mt-3">
                                                <div class="col-md-3">
                                                    <label for="provinces" class="form-label">จังหวัด :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['provinces_name']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="district" class="form-label">อำเภอ/เขต :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['district_name']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="subdistrict" class="form-label">ตำบล/แขวง :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['subdistrict_name']?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="zip_code" class="form-label">รหัสไปรษณีย์ :</label>
                                                    <div>
                                                        <label class="form-label"><?=$Address['zip_code']?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <br>
                                
                                <p align ="right">
                                    <a class="btn btn-outline-success text-decoration-none" href="update_request.php?user_id=<?=$_GET['user_id']?>&status=2">&emsp;<i class="fa-solid fa-check"></i>&nbsp;ตอบรับ&emsp;</a>&emsp;
                                    <a class="btn btn-outline-danger text-decoration-none" href="update_request.php?user_id=<?=$_GET['user_id']?>&status=5">&emsp;<i class="fa-sharp fa-solid fa-xmark"></i>&nbsp;ปฏิเสธ&emsp;</a>&emsp;
                                </p>

                                </div>
                           
                        </div>
                                
                    </div>
                </main>

               
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', event => {

                const allTable = document.getElementById('allTable');
                if (allTable) {
                    new simpleDatatables.DataTable(allTable);
                }
                const noTable = document.getElementById('noTable');
                if (noTable) {
                    new simpleDatatables.DataTable(noTable);
                }
                const readTable = document.getElementById('readTable');
                if (readTable) {
                    new simpleDatatables.DataTable(readTable);
                }
            });

        </script>
        <script>
            function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js.js" type="text/javascript"></script>
    </body>
</html>

<?php } ?>
