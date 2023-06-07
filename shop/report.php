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
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/Chart.min.js"></script>
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
                <div class="container px-4 px-lg-5 my-5">
                        <h1 class="mt-4">รายงานการเงิน</h1>
                        <hr>
                        <?php
                            $yeartotal = $sql->yeartotal($_SESSION['shop_id']);
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>เลขคำสั่งซื้อ</th>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ราคา</th>
                                            <th>การจัดส่ง</th> 
                                            <th>ราคารวม</th>
                                            <th>วันเวลา</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>เลขคำสั่งซื้อ</th>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ราคา</th>
                                            <th>การจัดส่ง</th> 
                                            <th>ราคารวม</th>
                                            <th>วันเวลา</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $allord = $sql->orders(5,$_SESSION['shop_id']);
                                        while($Allord=mysqli_fetch_array($allord)){
                                    ?>
                                        <tr>
                                            <td><?=$Allord['id']?></td>
                                            <td><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>" style="width: 96px;hieght: 96px;"></a></td>
                                            <td>
                                                <p><a class="text-dark text-decoration-none" href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                <p><?=$Allord['shop_name']?></p>
                                            </td>
                                            <td>
                                                <p><?=$Allord['pro_price']?> บาท</p>
                                                <p>x <?=$Allord['ord_amount']?></p>
                                            </td>
                                            
                                            <td>
                                                <p>นอกชุมชน</p>
                                                <p><?=$Allord['sent_price']?> บาท</p>
                                            </td>
                                            <td><?=$Allord['total_price']?></td>
                                            <td><?=$Allord['receive_date']?></td>
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
        <script>
            $(document).ready(function () {
                showGraph();
            });

            function showGraph() {

                $.post("data.php", function (data) {
                var day = [];
                var total = [];

                for (var i in data) {
                    var dayName = getDayName(data[i].day_number);
                    day.push(dayName);
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

            function getDayName(dayNumber) {
                var dayNames = [
                    "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"
                ];
                return dayNames[dayNumber - 1];
            }


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
            else{
            header("location: 401.php");}
        }
        else{
        header("location: 401.php");}
    }
    else{
    header("location: 401.php");}      
?>
