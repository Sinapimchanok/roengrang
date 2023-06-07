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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         
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

            .switch {
                width: 50px;
                height: 30px;
                display: flex;
                position: relative;
            }
            .chk {
                width: 0;
                height: 0;
                opacity: 0;
            }
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: #adadad;
                transition: .5s ease-in-out;
                border-radius: 50px;
            }
            .slider:before {
                content: "";
                position: absolute;
                width: 20px;
                height: 20px;
                top: 5px;
                left: 5px;
                background: #fff;
                border-radius: 50%;
                transition: 500ms ease-in-out;
            }
            .chk:checked + .slider {
                background: #198754;
            }
            .chk:checked + .slider:before {
                transform: translateX(20px);
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

                    <div class="container px-4 px-lg-5 mt-4">
                    <h1 class="mt-4">ข้อมูลร้านค้า</h1>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <?php
                                    $Pro = $sql->products($_GET['pro_id']);
                                    $pro=mysqli_fetch_array($Pro);
                                ?>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <center>
                                                    <img src="\roengrang\img/<?=$pro['pro_img']?>" alt="avatar" width="200" height="200">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <h5 class="form-label">ชื่อสินค้า : <?=$pro['pro_name']?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="form-label">ร้านค้า : <?=$pro['shop_name']?></h5>
                                            </div>
                                        </div><hr>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label class="form-label">ราคา :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['pro_price']?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">จำนวนคงเหลือ :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['pro_amount']?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">คะแนน :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['pro_point']?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label class="form-label">คนชอบ :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['pro_like']?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">ขายแล้ว :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['pro_selled']?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">วันที่ลงขาย :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['add_date']?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label class="form-label">หมวดหมู่ :</label>
                                                <div>
                                                    <label class="form-label"><?=$pro['cat_name']?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">สถานะสินค้า :</label>
                                                <div>
                                                    <label class="form-label">
                                                        <?php
                                                            switch ($pro['pro_status']) {
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
                                            <div class="col-md-4">
                                                <label class="form-label">ประเภทการส่ง :</label>
                                                <div>
                                                    <label class="form-label">
                                                    <?php
                                                            switch ($pro['pro_send']) {
                                                            case 1:
                                                                echo "ส่งเฉพาะภายในชุมชน";
                                                                break;
                                                            case 2:
                                                                echo "ส่งทั่วประเทศ";
                                                                break;
                                                            }
                                                        ?>  
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-4">
                                            <label class="form-label">รายละเอียด :</label>
                                            <div>
                                                <label class="form-label"><?=$pro['pro_detail']?></label>
                                            </div>
                                        </div>

                                        <hr>
                                    
                                        <p align ="right">
                                            <a class="text-decoration-none" href="editproduct.php?pro_id=<?=$pro['pro_id']?>">
                                                <button type="button" style="width:130px;" class="btn btn-primary">แก้ไขข้อมูล</button>
                                            </a>
                                            <input type=button class="btn btn-outline-danger text-decoration-none" onClick='window.history.back()' value='ย้อนกลับ'>
                                        </p>
                                    </div>
                                </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function status(pro_id,pro_status) {
                var pro_id,pro_status;
                //console.log(pro_id+" "+pro_status);
                $("#id_chk"+pro_id).change();
                $.ajax({
                    method: 'POST',
                    url: 'update_pro_status.php',
                    data: {
                        pro_id: pro_id
                    },
                });
            }
        </script>
    </body>
</html>

<?php } ?>
