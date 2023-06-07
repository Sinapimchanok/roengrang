<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    $allmem = $sql->allmember();
    $Allmem=mysqli_fetch_array($allmem) ; 

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
                    <div class="container px-4 px-lg-5 my-5">
                        <header>
                            <div class="row" style="display: flex; justify-content: center;">
                                <div class="col-2">
                                    <img class="card-img" src="\roengrang\img/ccece87530471f869a1002b7a4b40792.jpg" width="150px" height="150px"/>
                                </div>
                                <div class="col-4">
                                    <div class="text-center text-dark">
                                        <h5 class="display-5 mt-2 fw-bolder ">น้ำปั่นนายพล</h5>
                                        <p class="lead fw-normal text-dark-50 mb-0">ขายน้ำผลไม้ปั่น น้ำหวาน น้ำอัดลม</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </header>

                        <!-- Section-->
                        <section class="py-5">
                            <div class="container px-4 px-lg-5 mt-5">
                                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Fancy Product</h5>
                                                    <!-- Product price-->
                                                    $40.00 - $80.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="product.php">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Sale badge-->
                                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Special Item</h5>
                                                    <!-- Product reviews-->
                                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                    </div>
                                                    <!-- Product price-->
                                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                                    $18.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Sale badge-->
                                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Sale Item</h5>
                                                    <!-- Product price-->
                                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                                    $25.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Popular Item</h5>
                                                    <!-- Product reviews-->
                                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                    </div>
                                                    <!-- Product price-->
                                                    $40.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Sale badge-->
                                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Sale Item</h5>
                                                    <!-- Product price-->
                                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                                    $25.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Fancy Product</h5>
                                                    <!-- Product price-->
                                                    $120.00 - $280.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Sale badge-->
                                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Special Item</h5>
                                                    <!-- Product reviews-->
                                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                    </div>
                                                    <!-- Product price-->
                                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                                    $18.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder">Popular Item</h5>
                                                    <!-- Product reviews-->
                                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                        <div class="bi-star-fill"></div>
                                                    </div>
                                                    <!-- Product price-->
                                                    $40.00
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                                           
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

<?php } ?>