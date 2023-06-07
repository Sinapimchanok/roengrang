<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

    if ($_SESSION['user_role'] != "1") {
        header("location: 401.php");
    }else{

        $countrequest = $sql->countrequest();
        $countrequest=mysqli_fetch_array($countrequest);

        $countuser = $sql->countuser();
        $countuser=mysqli_fetch_array($countuser);

        $countshop = $sql->countshop();
        $countshop=mysqli_fetch_array($countshop);

        $countproduct = $sql->countproduct();
        $countproduct=mysqli_fetch_array($countproduct);

        $countreportshop = $sql->countreportshop();
        $countreportshop=mysqli_fetch_array($countreportshop);

        $countreportproduct = $sql->countreportproduct();
        $countreportproduct=mysqli_fetch_array($countreportproduct);
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
        <link rel="icon" type="image/png" href="\roengrang\img/logo1.png">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            
            <a class="navbar-brand ps-1" href="index.php">
                <img src="https://res.cloudinary.com/dlne5j5ub/image/upload/v1686072817/logo1_fo37mz.png" alt="logo" height="36"> ร้านค้าชุมชนเริงราง
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

                            <a class="nav-link" href="catagory.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                หมวดหมู่สินค้า
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
                        <h1 class="mt-4">ภาพรวมของระบบ</h1>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 text-center" style="cursor:pointer;" onclick="window.location.href = 'request.php'">
                                <div class="card border-primary mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text text-primary">
                                                <h3><?=$countrequest['countrequest']?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-primary">
                                        <div class="row">
                                            <div class="text text-white">
                                                <h5>คำร้องขอสมัครสมาชิก</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 text-center" style="cursor:pointer;" onclick="window.location.href = 'member.php'">
                                <div class="card border-info mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text text-info">
                                                <h3><?=$countuser['countuser']?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-info">
                                        <div class="row">
                                            <div class="text text-white">
                                                <h5>จำนวนผู้ใช้งาน</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 text-center" style="cursor:pointer;" onclick="window.location.href = 'shop.php'">
                                <div class="card border-success mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text text-success">
                                                <h3><?=$countshop['countshop']?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-success">
                                        <div class="row">
                                            <div class="text text-white">
                                                <h5>จำนวนร้านค้า</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 text-center" style="cursor:pointer;" onclick="window.location.href = 'allproduct.php'">
                                <div class="card border-danger mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text text-danger">
                                                <h3><?=$countproduct['countproduct']?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-danger">
                                        <div class="row">
                                            <div class="text text-white">
                                                <h5>จำนวนสินค้า</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card mb-4" style="cursor:pointer;" onclick="window.location.href = 'report_pro.php'">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="card p-2 bg-primary text-center text-white">
                                            รายงานปัญหาร้านค้า
                                            </div>
                                        </div>
                                        <div class="col-3 p-2 text-center">
                                            <?=$countreportshop['countreportshop']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card mb-4" style="cursor:pointer;" onclick="window.location.href = 'report_shop.php'">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="card p-2 bg-primary text-center text-white">
                                            รายงานปัญหาสินค้า
                                            </div>
                                        </div>
                                        <div class="col-3 p-2 text-center">
                                            <?=$countreportproduct['countreportproduct']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $yeartotal = $sql->yeartotal();
                            $yeartotal=mysqli_fetch_array($yeartotal);
                        ?>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                ยอดขายประจำปี พ.ศ.<?=date("Y")+543?>
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                ยอดรวมสุทธิ <?=$yeartotal['total_year']?> บาท
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="card-body">
                                        <canvas id="year" width="100%" height="40"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                ยอดขายประจำสัปดาห์
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                ยอดรวมสุทธิ <?=$yeartotal['total_week']?> บาท
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="week" width="100%" height="40"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                ร้านค้าขายดีที่สุด
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="bestshop">
                                            <thead>
                                                <tr>
                                                    <th>ร้านค้า</th>
                                                    <th>รายได้</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ร้านค้า</th>
                                                    <th>รายได้</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                                                $shopbest = $sql->bestshop();
                                                while($Shopbest=mysqli_fetch_array($shopbest)){
                                            ?>
                                                <tr >
                                                    <td>
                                                        <div class="row p-2" style="cursor:pointer;" onclick="window.location.href='shop_detail.php?shop_id=<?= $Shopbest['shop_id'] ?>'">
                                                            <?=$Shopbest['No.']?>. <?=$Shopbest['shop_name']?>
                                                        </div>   
                                                    </td>
                                                    <td>
                                                        <div class="row p-1" style="cursor:pointer;" onclick="window.location.href='shop_detail.php?shop_id=<?= $Shopbest['shop_id'] ?>'">
                                                            <?=$Shopbest['total_price_sum']?>
                                                        </div>   
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
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                สินค้าขายดีที่สุด
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="bestproduct">
                                            <thead>
                                                <tr>
                                                    <th>สินค้า</th>
                                                    <th>ขายแล้ว</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>สินค้า</th>
                                                    <th>ขายแล้ว</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                                                $productsbest = $sql->bestproducts();
                                                while($bestproducts=mysqli_fetch_array($productsbest)){
                                            ?>
                                                <tr >
                                                    <td>
                                                        <div class="row p-2" style="cursor:pointer;" onclick="window.location.href='product_detail.php?pro_id=<?= $bestproducts['pro_id'] ?>'">
                                                            <?=$bestproducts['No.']?>. <?=$bestproducts['pro_name']?>
                                                        </div>   
                                                    </td>
                                                    <td>
                                                        <div class="row p-1" style="cursor:pointer;" onclick="window.location.href='product_detail.php?pro_id=<?= $bestproducts['pro_id'] ?>'">
                                                            <?=$bestproducts['pro_selled']?>
                                                        </div>   
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
                        </div>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            window.addEventListener('DOMContentLoaded', event => {

                const bestshop = document.getElementById('bestshop');
                if (bestshop) {
                    new simpleDatatables.DataTable(bestshop);
                }
                const bestproduct = document.getElementById('bestproduct');
                if (bestproduct) {
                    new simpleDatatables.DataTable(bestproduct);
                }
            });

            $(document).ready(function () {
                showGraph();
            });

            function showGraph() {

                $.post("data.php",
                    function (data)
                    {
                        console.log(data);
                        var day = [];
                        var total = [];

                        for (var i in data) {
                            day.push(data[i].day_name);
                            total.push(data[i].total_price);
                        }

                        var chartdata = {
                            labels: day,
                            datasets: [
                                {
                                    label: 'ยอดขายในแต่ละวัน',
                                    backgroundColor: '#49e2ff',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: total
                                }
                            ]
                        };

                        var graphTarget = $("#week");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata
                        });
                    });

                $.post("datamount.php", function (data) {
                    var month = [];
                    var total = [];

                    for (var i in data) {
                        // Convert the month number to a month name
                        var monthName = getMonthName(data[i].month_number);
                        month.push(monthName);
                        total.push(data[i].total_price);
                    }
                    var chartdata = {
                        labels: month,
                        datasets: [
                            {
                                label: 'ยอดขาย',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: total,
                            }
                        ]
                    };

                    var graphTarget = $("#year");
                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }

            function getMonthName(monthNumber) {
                var monthNames = [
                    "ม.ค.", "ก.พ.", "มี.ค.", "เม.ษ.", "พ.ค.", "มิ.ย",
                    "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."
                ];
                return monthNames[monthNumber - 1];
            }

        </script>
    </body>
</html>

<?php 
    }
?>
    