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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
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
                        <div calss="row">
                        <?php
                            $allpro = $sql->whatcatagory($_GET['id']);
                            $cat=mysqli_fetch_array($allpro)
                        ?>
                            <div class="col-md-4"><h1 class="mt-4">หมวดหมู่ <?=$cat['cat_name']?></h1></div>
                        </div>
                        
                        <hr>
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
                                        $allpro = $sql->cat_products($_GET['id']);
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

<?php
    }
?>



