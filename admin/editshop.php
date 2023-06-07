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

                    <div class="container px-4 px-lg-5 mt-5">
                    <h1 class="mt-4">ข้อมูลร้านค้า</h1>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <?php
                                    $Shop = $sql->shop($_GET['shop_id']);
                                    $shop=mysqli_fetch_array($Shop);
                                ?>
                                <form action="product_upload.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col">
                                                <CENTER>
                                                <div class="col-md-9">
                                                    <img class="card-img mb-5 mb-md-0" id="blah" src="\roengrang\img/<?=$shop['shop_img']?>" alt="avatar" width="200" height="200"/>
                                                </div>
                                                </CENTER>
                                                <CENTER>
                                                <div class="col-10">
                                                    <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                                                    <input class="form-control" hidden id="img_name" name="img_name" type="text" value="<?=$shop['shop_img']?>" />
                                                    <input class="form-control" hidden id="shop_id" name="shop_id" type="text" value="<?=$_GET['shop_id']?>" />
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
                                        <div class="row mt-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="shop_name" name="shop_name" type="text" value="<?=$shop['shop_name']?>" placeholder="ชื่อร้านค้า" />
                                                        <label for="inputName">ชื่อร้านค้า</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">เจ้าของ :</label>
                                                <div>
                                                    <label class="form-label"><?=$shop['user_fullname']?></label>
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
                                            <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="shop_detail" name="shop_detail" placeholder="รายละเอียด"><?=$shop['shop_detail']?></textarea>
                                                        <label for="inputDetail">รายละเอียด</label>
                                                    </div>
                                            </div>
                                        <hr>
                                    
                                        <p class="mt-3" ALIGN="right" >
                                            <button type="submit" name="updateShop" style="width:130px; height:60; font-size:17px;" class="btn btn-success">ยันยัน</button>
                                            <input type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-outline-danger text-decoration-none" onClick='window.history.back()' value='ย้อนกลับ'>
                                        </p>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th>รูปสินค้า</th>
                                            <th>ราคา</th>
                                            <th>จำนวนคงเหลือ</th>
                                            <th>เวลา</th>
                                            <th>สถานะ</th>
                                            <th>การทำงาน</th>
                                            <!--<th>ลบสินค้า</th>-->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th>รูปสินค้า</th>
                                            <th>ราคา</th>
                                            <th>จำนวนคงเหลือ</th>
                                            <th>เวลา</th>
                                            <th>สถานะ</th>
                                            <th>การทำงาน</th>
                                            <!--<th>ลบสินค้า</th>-->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $allpro = $sql->shop_products($_GET['shop_id']);
                                        while($Allpro=mysqli_fetch_array($allpro)){
                                    ?>
                                        <tr>
                                            <td><?=$Allpro['pro_name']?></td>
                                            <td><img class="card-img" src="\roengrang\img/<?=$Allpro['pro_img']?>" style="width: 75px;hieght: 75px;"  /></td>
                                            <td><?=$Allpro['pro_price']?> บาท</td>
                                            <td><?=$Allpro['pro_amount']?></td>
                                            <td>
                                                <div>เวลาสร้างสินค้า</div>
                                                <div><?=$Allpro['add_date']?></div>
                                                <div>เวลาแก้ไขสินค้า</div>
                                                <div>2011/04/25</div>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="chk" id="id_chk<?=$Allpro['pro_id']?>" onclick="status(<?=$Allpro['pro_id']?>,<?=$Allpro['pro_status']?>)" <?php echo($Allpro['pro_status'] != 0)?'checked':''; ?>>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            <td>
                                            <a class="text-decoration-none" href="product_detail.php?pro_id=<?=$Allpro['pro_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;"class="btn btn-outline-primary">ดูเพิ่มเติม</button></a>

                                                <a class="text-decoration-none" href="editproduct.php?pro_id=<?=$Allpro['pro_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-primary">แก้ไขสินค้า</button></a>
          
                                                <a class="text-decoration-none" href="delete.php?pro_id=<?=$Allpro['pro_id']?>&what=products">   
                                                    <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-danger">ลบสินค้า</button></a>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
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
