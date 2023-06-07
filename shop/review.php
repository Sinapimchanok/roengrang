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
                <div class="container px-4 px-lg-5 mt-4">
                        <h1 class="mt-4">รีวิวคำสั่งซื้อ</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">สำหรับคนในชุมชน กรุณาตรวจสอบข้อมูลของผู้สมัครว่าเป็นจริงหรือไม่</li>
                        </ol> -->
                        <hr>
                        <div class="card">
                        <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'all')" id="defaultOpen">รีวิวคำสั่งซื้อ</button>
                            <button class="tablinks" onclick="openCity(event, 'noread')">รายงานปัญหาสินค้าที่ยังไม่ได้อ่าน</button>
                            <button class="tablinks" onclick="openCity(event, 'read')">รายงานปัญหาสินค้าที่อ่านแล้ว</button>
                        </div>

                        <div id="all" class="tabcontent">
                            <div class="card-body">
                                <table id="allTable">
                                    <thead>
                                        <tr>
                                            <th>เลขที่คำสั่งซื้อ</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>เลขที่คำสั่งซื้อ</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $review = $sql->orderReview($_SESSION['shop_id']);
                                        while($Review=mysqli_fetch_array($review)){
                                    ?>
                                        <tr>
                                            <td><?=$Review['id']?></td>
                                            <td><img src="\roengrang\img/<?=$Review['pro_img']?>" style="width: 76px;height: 76px;" /> <?=$Review['pro_name']?> </td>
                                            <td><?=$Review['user_fullname']?> บาท</td>
                                            <td><?=$Review['review_date']?></td>
                                            <td><a href="reviewDetail.php?order=<?=$Review['id']?>">ดูเพิ่มเติม</a></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="noread" class="tabcontent">
                            <div class="card-body">
                                <table id="noTable">
                                    <thead>
                                        <tr>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                        </tr>
                                    </tfoot>
                                    
                                </table>
                            </div>
                        </div>

                        <div id="read" class="tabcontent">
                            <div class="card-body">
                                <table id="readTable">
                                    <thead>
                                        <tr>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ผู้รายงาน</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                        </tr>
                                    </tfoot>
                                    
                                </table>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
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
