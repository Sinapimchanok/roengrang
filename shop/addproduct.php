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
                    <div class="container px-4 px-lg-5 my-4">
                    <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php 
                                echo $_SESSION['statusMsg']; 
                                unset($_SESSION['statusMsg']);
                            ?>
                        </div>
                    <?php } ?>
                        <form action="product_upload.php" method="POST" enctype="multipart/form-data">
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6">
                                    <CENTER>
                                    <div class="col-md-9">
                                        <img class="card-img mb-5 mb-md-0" id="blah" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" height="380px" />
                                    </div>
                                    </CENTER>
                                    <CENTER>
                                    <div class="col-md-7">
                                        <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                                    </div>
                                    </CENTER>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="pro_name" name="pro_name" type="text" placeholder="ชื่อสินค้า" />
                                        <label for="inputName">ชื่อสินค้า</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="pro_price" name="pro_price" type="number" placeholder="ราคา" />
                                                <label for="inputPrice">ราคา</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="pro_amount" name="pro_amount" type="number" placeholder="จำนวน" />
                                                <label for="inputDetail">จำนวน</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="cat_id" id="cat_id" placeholder="หมวดหมู่" required>
                                                    <option value="" selected disabled>-กรุณาเลือกหมวดหมู่-</option>
                                                    <option value="1" >อุปโภค</option>
                                                    <option value="2" >บริโภค</option>
                                                </select>
                                                <label for="cat_id">หมวดหมู่</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="pro_send" id="pro_send" placeholder="การขายสินค้า" required>
                                                    <option value="" selected disabled>-กรุณาเลือกการขาย-</option>
                                                    <option value="1" >ขายสินค้าเฉพาะภายในชุมชน</option>
                                                    <option value="2" >ขายสินค้าทั่วประเทศ</option>
                                                </select>
                                                <label for="pro_send">การขายสินค้า</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="pro_detail" name="pro_detail" placeholder="รายละเอียด"></textarea>
                                        <label for="inputDetail">รายละเอียด</label>
                                    </div>
                                    
                                    <p class="mt-3" ALIGN="center" >
                                        <button type="submit" name="addPro" class="btn btn-primary">ลงขายสินค้า</button>
                                    </p>
                                    </div>
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
    </body>
</html>

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
