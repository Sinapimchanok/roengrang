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

            /* Style the tab */
            .tab {
            overflow: hidden;
            margin : 10px 16px 0px;
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
                        <div class="row">
                            <div class="col-6">
                                <h1 >สมาชิก</h1>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <button class="btn btn-outline-primary"><a class="text text-decoration-none" href="addmember.php">เพิ่มสมาชิก</a></button>
                            </div>
                        </div>
                        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['statusMsg']; 
                                    unset($_SESSION['statusMsg']);
                                ?>
                            </div>
                        <?php } ?>
                        <hr>
                        <div class="card">
                        <div class="tab">
                            <button class="tablinks" onclick="openCity(event, 'allmember')" id="defaultOpen">สมาชิกทั้งหมด</button>
                            <button class="tablinks" onclick="openCity(event, 'groupmember')">สมาชิกภายในชุมชน</button>
                            <button class="tablinks" onclick="openCity(event, 'generalmember')">สมาชิกภายนอกชุมชน</button>
                            <button class="tablinks" onclick="openCity(event, 'adminmember')">สมาชิกผู้ดูแลระบบ</button>
                        </div>

                        <div id="allmember" class="tabcontent">
                            
                                <table id="AllmemTable">
                                    <thead>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>ประเภท</th>
                                            <th>เวลา</th>
                                            <th>สถานะ</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>ประเภท</th>
                                            <th>เวลา</th>
                                            <th>สถานะ</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $allmem = $sql->allmember();
                                            while($Allmem=mysqli_fetch_array($allmem)){
                                        ?>
                                        <tr>
                                            <td><img class="card-img" src="\roengrang\img/<?=$Allmem['user_img']?>" style="width: 76px;height: 76px;" /></td>
                                            <td><?=$Allmem['user_fullname']?></td>
                                            <td>
                                                <?php
                                                    switch ($Allmem['user_role']) {
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
                                            </td>
                                            <td>
                                                <div>เป็นสมาชิกเมื่อ</div>
                                                <div><?=$Allmem['user_regDate']?></div>
                                                <div>แก้ไขล่าสุด</div>
                                                <div>2011/04/25</div>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="chk" id="id_chk<?=$Allmem['user_id']?>" onclick="status(<?=$Allmem['user_id']?>,<?=$Allmem['user_status']?>)" <?php echo($Allmem['user_status'] == 1)?'checked':''; ?>>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a class="text-decoration-none" href="member_detail.php?user_id=<?=$Allmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;"class="btn btn-outline-primary">ดูเพิ่มเติม</button></a>

                                                <a class="text-decoration-none" href="editmember.php?user_id=<?=$Allmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-primary">แก้ไขข้อมูล</button></a>
                                                
                                                <a class="text-decoration-none" href="delete.php?user_id=<?=$Allmem['user_id']?>&what=user">   
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-danger">ลบบัญชี</button></a>
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>

                        <div id="groupmember" class="tabcontent">
                            
                                <table id="groupTable">
                                    <thead>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        
                                            $groupmem = $sql->groupmember();
                                            while($Groupmem=mysqli_fetch_array($groupmem)){
                                        ?>
                                        <tr>
                                            <td><img class="card-img" src="\roengrang\img/<?=$Groupmem['user_img']?>.jpg" style="width: 96px;hieght: 96px;"  /></td>
                                            <td><?=$Groupmem['user_fullname']?></td>
                                            <td>
                                                <?php
                                                    switch ($Groupmem['user_role']) {
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
                                            </td>
                                            <td>
                                                <div>เป็นสมาชิกเมื่อ</div>
                                                <div><?=$Groupmem['user_regDate']?></div>
                                                <div>แก้ไขล่าสุด</div>
                                                <div>2011/04/25</div>
                                            </td>
                                            <td>
                                            <a class="text-decoration-none" href="member_detail.php?user_id=<?=$Groupmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;"class="btn btn-outline-primary">ดูเพิ่มเติม</button></a>

                                                <a class="text-decoration-none" href="editmember.php?user_id=<?=$Groupmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-primary">แก้ไขข้อมูล</button></a>
                                                
                                                <a class="text-decoration-none" href="delete.php?user_id=<?=$Groupmem['user_id']?>&what=user">   
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-danger">ลบบัญชี</button></a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>

                        <div id="generalmember" class="tabcontent">
                            
                                <table id="genTable">
                                    <thead>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        
                                            $genmem = $sql->genmember();
                                            while($Genmem=mysqli_fetch_array($genmem)){
                                        ?>
                                        <tr>
                                            <td><img class="card-img" src="\roengrang\img/<?=$Genmem['user_img']?>.jpg" style="width: 96px;hieght: 96px;"  /></td>
                                            <td><?=$Genmem['user_fullname']?></td>
                                            <td>
                                                <?php
                                                    switch ($Genmem['user_role']) {
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
                                            </td>
                                            <td>
                                                <div>เป็นสมาชิกเมื่อ</div>
                                                <div><?=$Genmem['user_regDate']?></div>
                                                <div>แก้ไขล่าสุด</div>
                                                <div>2011/04/25</div>
                                            </td>
                                            <td>
                                            <a class="text-decoration-none" href="member_detail.php?user_id=<?=$Genmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;"class="btn btn-outline-primary">ดูเพิ่มเติม</button></a>

                                                <a class="text-decoration-none" href="editmember.php?user_id=<?=$Genmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-primary">แก้ไขข้อมูล</button></a>
                                                
                                                <a class="text-decoration-none" href="delete.php?user_id=<?=$Genmem['user_id']?>&what=user">   
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-danger">ลบบัญชี</button></a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>

                        <div id="adminmember" class="tabcontent">
                            
                                <table id="adminTable">
                                    <thead>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปถ่าย</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>เวลา</th>
                                            <th>การทำงาน</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        
                                            $adminmem = $sql->adminmember();
                                            while($Adminmem=mysqli_fetch_array($adminmem)){
                                        ?>
                                        <tr>
                                            <td><img class="card-img" src="\roengrang\img/<?=$Adminmem['user_img']?>.jpg" style="width: 96px;hieght: 96px;"  /></td>
                                            <td><?=$Adminmem['user_fullname']?></td>
                                            <td>
                                                <?php
                                                    switch ($Adminmem['user_role']) {
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
                                            </td>
                                            <td>
                                                <div>เป็นสมาชิกเมื่อ</div>
                                                <div><?=$Adminmem['user_regDate']?></div>
                                                <div>แก้ไขล่าสุด</div>
                                                <div>2011/04/25</div>
                                            </td>
                                            <td>
                                            <a class="text-decoration-none" href="member_detail.php?user_id=<?=$Adminmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;"class="btn btn-outline-primary">ดูเพิ่มเติม</button></a>

                                                <a class="text-decoration-none" href="editmember.php?user_id=<?=$Adminmem['user_id']?>">
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-primary">แก้ไขข้อมูล</button></a>
                                                
                                                <a class="text-decoration-none" href="delete.php?user_id=<?=$Adminmem['user_id']?>&what=user">   
                                                <button type="button" style="width:130px; height:60; font-size:17px;" class="btn btn-danger">ลบบัญชี</button></a>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            window.addEventListener('DOMContentLoaded', event => {

                const AllmemTable = document.getElementById('AllmemTable');
                if (AllmemTable) {
                    new simpleDatatables.DataTable(AllmemTable);
                }
                const groupTable = document.getElementById('groupTable');
                if (groupTable) {
                    new simpleDatatables.DataTable(groupTable);
                }
                const genTable = document.getElementById('genTable');
                if (genTable) {
                    new simpleDatatables.DataTable(genTable);
                }
                const adminTable = document.getElementById('adminTable');
                if (adminTable) {
                    new simpleDatatables.DataTable(adminTable);
                }
            });

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

            function status(user_id,user_status) {
                var user_id,user_status;
                //console.log(user_id+" "+user_status);
                $("#id_chk"+user_id).change();
                $.ajax({
                    method: 'POST',
                    url: 'update_status.php',
                    data: {
                        user_id: user_id
                    },
                });
            }

        </script>
    </body>
</html>

<?php
    }
?>