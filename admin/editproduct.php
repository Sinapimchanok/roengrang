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
                    <h1 class="mt-4">แก้ไขข้อมูลสินค้า</h1>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <?php
                                    $Pro = $sql->products($_GET['pro_id']);
                                    $pro=mysqli_fetch_array($Pro);
                                ?>
                                
                                <form action="product_upload.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col">
                                                <CENTER>
                                                <div class="col-md-9">
                                                    <img class="card-img mb-5 mb-md-0" id="blah" src="\roengrang\img/<?=$pro['pro_img']?>" alt="avatar" width="200" height="200"/>
                                                </div>
                                                </CENTER>
                                                <CENTER>
                                                <div class="col-10">
                                                    <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                                                    <input class="form-control" hidden id="img_name" name="img_name" type="text" value="<?=$pro['pro_img']?>" />
                                                    <input class="form-control" hidden id="pro_id" name="pro_id" type="text" value="<?=$pro['pro_id']?>" />
                                                </div>
                                                </CENTER>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php 
                                                echo $_SESSION['statusMsg']; 
                                                unset($_SESSION['statusMsg']);
                                            ?>
                                        </div>
                                    <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="pro_name" name="pro_name" type="text" value="<?=$pro['pro_name']?>" placeholder="ชื่อสินค้า" />
                                                    <label for="inputName">ชื่อสินค้า</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="pro_price" name="pro_price" type="number" value="<?=$pro['pro_price']?>" placeholder="ราคา" />
                                                    <label for="inputPrice">ราคา</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="pro_amount" name="pro_amount" type="number" value="<?=$pro['pro_amount']?>" placeholder="จำนวน" />
                                                    <label for="inputDetail">จำนวน</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="cat_id" id="cat_id" placeholder="หมวดหมู่" required>
                                                        <option value="<?=$pro['cat_id']?>" selected><?=$pro['cat_name']?></option>
                                                        <option value="1" >อุปโภค</option>
                                                        <option value="2" >บริโภค</option>
                                                    </select>
                                                    <label for="cat_id">หมวดหมู่</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="pro_send" id="pro_send" placeholder="การขายสินค้า" required>
                                                        <option value="<?=$pro['pro_send']?>" selected>
                                                        <?php
                                                            switch ($pro['pro_send']) {
                                                                case 1:
                                                                    echo "ขายสินค้าเฉพาะภายในชุมชน";
                                                                    break;
                                                                case 2:
                                                                    echo "ขายสินค้าทั่วประเทศ";
                                                                    break;
                                                            }
                                                        ?>
                                                        </option>
                                                        <option value="1" >ขายสินค้าเฉพาะภายในชุมชน</option>
                                                        <option value="2" >ขายสินค้าทั่วประเทศ</option>
                                                    </select>
                                                    <label for="pro_send">การขายสินค้า</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="pro_detail" name="pro_detail" placeholder="รายละเอียด"><?=$pro['pro_detail']?></textarea>
                                            <label for="inputDetail">รายละเอียด</label>
                                        </div>
                                        
                                        <p class="mt-3" ALIGN="right" >
                                            <button type="submit" name="updatePro" style="width:130px; height:60; font-size:17px;" class="btn btn-success">ยันยัน</button>
                                            <a class="text-decoration-none" href="allproduct.php">   
                                                        <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-outline-danger text-decoration-none">ย้อนกลับ</button>
                                                    </a>

                         
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                </form>
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
