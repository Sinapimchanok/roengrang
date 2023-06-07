<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    $query = $sql->province();

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
                                รายงานปํญหา
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="problem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="report_shop.php">รายงานปัญหาสินค้า</a>
                                    <a class="nav-link" href="report_shop.php">รายงานปัญหาสินค้า</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container px-4 px-lg-5 mt-5">
                        <h1 class="mt-5">แก้ไขข้อมูลสมาชิก</h1>
                        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['statusMsg']; 
                                    unset($_SESSION['statusMsg']);
                                ?>
                            </div>
                        <?php } 
                        $mem = $sql->member($_GET['user_id']);
                        $Mem=mysqli_fetch_array($mem);
                        $address = $sql->useraddress($_GET['user_id']);
                        $Address=mysqli_fetch_array($address);
                        ?>
                        <hr>
                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-3">
                                <div class="row mt-3">
                                    <div class="col">
                                        <CENTER>
                                        <div class="col-md-9">
                                            <img class="card-img mb-5 mb-md-0" id="blah" src="\roengrang\img/<?=$Mem['user_img']?>" alt="avatar" width="200" height="200"/>
                                        </div>
                                        </CENTER>
                                        <CENTER>
                                        <div class="col-10">
                                            <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                                            <input class="form-control" hidden id="img_name" name="img_name" type="text" value="<?=$Mem['user_img']?>" />
                                            <input class="form-control" hidden id="user_id" name="user_id" type="text" value="<?=$Mem['user_id']?>" />
                                        </div>
                                        </CENTER>
                                    </div>
                                </div>
                                </div>
                                <div class="col-9">
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">อีเมล :</label>
                                            <input type="text" class="form-control" id="email" name="user_email" value="<?=$Mem['user_email']?>" onblur="checkemail(this.value)">
                                            <span id="useremailavailable"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password" class="form-label">รหัสผ่าน :</label>
                                            <input type="text" class="form-control" id="password" name="user_password" value="<?=$Mem['user_password']?>" onblur="checkpassword(this.value)">
                                            <span id="checkpassword"></span>
                                        </div> 
                                        <div class="col-md-4">
                                            <label for="user_fullname" class="form-label">ชื่อ-นามสกุล :</label>
                                            <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?=$Mem['user_fullname']?>" >
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">
                                            <label for="user_tel" class="form-label">เบอร์โทรศัพท์ :</label>
                                            <input type="text" class="form-control" id="user_tel" name="user_tel" minlength="10" maxlength="10" value="<?=$Mem['user_tel']?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address" class="form-label">ที่อยู่(บ้านเลขที่ และ หมู่) :</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?=$Mem['user_address']?>" required >
                                        </div>
                                        <div class="col-md-3">
                                            <label for="road" class="form-label">ถนน :</label>
                                            <input type="text" class="form-control" id="road" name="road" value="<?=$Mem['user_road']?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="soi" class="form-label">ตรอก/ซอย :</label>
                                            <input type="text" class="form-control" id="soi" name="soi" value="<?=$Mem['user_soi']?>" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="provinces" class="form-label">จังหวัด :</label>
                                            <select class="form-control mt-1 mb-1 " name="provinces" id="provinces" required>
                                                <option value="<?=$Address['province_id']?>" selected ><?=$Address['user_province']?></option>
                                                <?php foreach ($query as $value) { ?>
                                                <option value="<?=$value['code']?>" ><?=$value['name_th']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="district" class="form-label">อำเภอ/เขต :</label>
                                            <select class="form-control mt-1 mb-1" name="district" id="district" required>
                                            <option value="<?=$Address['district_id']?>" selected ><?=$Address['user_district']?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="subdistrict" class="form-label">ตำบล/แขวง :</label>
                                            <select class="form-control mt-1 mb-1" name="subdistrict" id="subdistrict" required>
                                            <option value="<?=$Address['subdistrict_id']?>" selected ><?=$Address['user_subdistrict']?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip_code" class="form-label">รหัสไปรษณีย์ :</label>
                                            <input type="text" name="zip_code" id="zip_code" value="<?=$Address['user_zipcode']?>" class="form-control mt-1 mb-1" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="user_role" class="form-label">สถานะของผู้ใช้ :</label>
                                            <select class="form-control mt-1 mb-1" name="user_role" id="user_role" required>
                                                <option value="<?=$Mem['user_role']?>" selected  >
                                                <?php
                                                    switch ($Mem['user_role']) {
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
                                                </option>
                                                <option value="1" >ผู้ดูแลระบบ</option>
                                                <option value="2" >สมาชิกภายในชุมชน</option>
                                                <option value="3" >สมาชิกภายนอกชุมชน</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p class="mt-3" ALIGN="right" >
                                        <button type="submit" name="updateUser" style="width:130px; height:60; font-size:17px;" class="btn btn-success">ยันยัน</button>
                                        <input type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-outline-danger text-decoration-none" onClick='window.history.back()' value='ย้อนกลับ'>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        <script>
            function checkemail(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checkemail_available.php',
                    data: 'email='+val,
                    success: function(data) {
                        $('#useremailavailable').html(data);
                    }
                });
            }
            
            
        </script>
    
        <?php include('script.php');?>
    </body>
</html>

<?php
    }
?>


