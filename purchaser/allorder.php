<?php 
    session_start();
    include_once('functions.php');  

	$sql = new DB_con();

	$cart = $sql->cart($_SESSION['id']);
	$rs = $sql->rowsum($_SESSION['id']);
	$RS=mysqli_fetch_array($rs);

	if ($RS[0]>0){
		$row = $RS[0];
	}else{$row = 0 ;}

    if ($_SESSION['user_role'] != 2) {
        header("location: /roengrang/error/401.php");
    }else{
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Roengrang Shop</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/Logo3.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		.header.shop .search-bar input {
			display: inline-block;
			float: left;
			height: 48px;
			background: transparent;
			color: #666;
			border-radius: 0;
			border: none;
			font-size: 14px;
			font-weight: 400;
			padding: 0 25px 0 20px ;
			width: 328px;
		}
	</style>    
</head>
<body class="js">
	
	<!-- Preloader -->
	<!-- End Preloader -->
		
		<!-- Header -->
        <header class="header shop">
            <!-- Topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-12">
                            <!-- Top Left -->
                            <div class="top-left">
                                <ul class="list-main">
                                    <li><i class="ti-headphone-alt"></i>060 801-582</li>
                                    <li><i class="ti-email"></i> Roengrang.18160@gmail.com</li>
                                </ul>
                            </div>
                            <!--/ End Top Left -->
                        </div>
                        <div class="col-lg-7 col-md-12 col-12">
                            <!-- Top Right -->
                            <div class="right-content">
                                <ul class="list-main">
                                    <li><i class="ti-bag"></i> <a href="goShop.php">ร้านค้าของฉัน</a></li>
                                    <li><i class="ti-user"></i> <a href="#"><?=$_SESSION['fname']?></a></li>
                                    <li><i class="ti-power-off"></i><a href="/roengrang/logout.php">ออกจากระบบ</a></li>
                                </ul>
                            </div>
                            <!-- End Top Right -->
                        </div>
                    </div>
                </div>
            </div>
			<!-- End Topbar -->
			<div class="middle-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-12">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php"><img src="images/Logo4.png" alt="logo" hieght=""></a>
                            </div>
                            <!--/ End Logo -->
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <div class="search-bar-top">
                                <div class="search-bar">
									
                                    <select id="cat" name="cat">
                                        <option selected="selected" value="0">หมวดหมู่ทั้งหมด</option>
										<?php
											$cat = $sql->catagory();
                                            while($Cat=mysqli_fetch_array($cat)){
                                        ?>
                                        <option value="<?=$Cat['id']?>"><?=$Cat['cat_name']?></option>
										<?php
											}
										?>
										<option value="shop">ร้านค้า</option>
                                    </select>
									<input id="search" name="search" placeholder="ค้นหาที่นี่....." type="search">
									<button id="searchbtn" class="btnn" ><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12">
                            <div class="right-bar">
                                <!-- Search Form -->
                                <div class="sinlge-bar">
                                    <a href="productlike.php"><i class="fa fa-heart" aria-hidden="true"></i> สินค้าที่ถูกใจ</a>
                                </div>
                                <div class="sinlge-bar shopping">
									<a  class="single-icon" href="cart.php"><i class="ti-shopping-cart-full"></i> <span class="total-count" id="cartcount"><?=$RS['count']?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!-- Header Inner -->
			<div class="header-inner">
                <div class="container">
                    <div class="cat-nav-head">
                        <div class="row" >
                            <div class="col-12">
                                <div class="menu-area" style="display: flex; justify-content: center;">
                                    <!-- Main Menu -->
                                    <nav class="navbar navbar-expand-lg">
                                        <div class="navbar-collapse">	
                                            <div class="nav-inner">	
                                                <ul class="nav main-menu menu navbar-nav">
                                                        <li class="active"><a href="index.php">หน้าหลัก</a></li>
                                                        <li><a href="allproduct.php">สินค้า</a></li>	
                                                        <!-- <li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                            <ul class="dropdown">
                                                                <li><a href="shop-grid.php">Shop Grid</a></li>
                                                                <li><a href="checkout.php">Checkout</a></li>
                                                            </ul>
                                                        </li>								 -->
                                                        <!-- <li><a href="#">Blog<i class="ti-angle-down"></i></a>
                                                            <ul class="dropdown">
                                                                <li><a href="blog-single-sidebar.php">Blog Single Sidebar</a></li>
                                                            </ul>
                                                        </li> -->
                                                        <li><a href="cart.php">ตะกร้าสินค้า</a></li>
                                                        <li class="active"><a>รายการสั่งซื้อ</a></li>
                                                    </ul>
                                            </div>
                                        </div>
                                    </nav>
                                    <!--/ End Main Menu -->	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Header Inner -->
        </header>
		<!--/ End Header -->
	
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index.php">หน้าหลัก<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="allorder.php">รายการสั่งซื้อ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

    	<!-- Start Product Area -->
        <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>รายการคำสั่งซื้อของฉัน</h2>
						</div>
					</div>
				</div>
                <?php
                    $numall = $sql->countallorder($_SESSION['id']);
                    $numall=mysqli_fetch_array($numall);

                    $numnew = $sql->countorder(0,$_SESSION['id']);
                    $numnew=mysqli_fetch_array($numnew);

                    $numdoing = $sql->countorder(1,$_SESSION['id']);
                    $numdoing=mysqli_fetch_array($numdoing);

                    $numprepare = $sql->countorder(2,$_SESSION['id']);
                    $numprepare=mysqli_fetch_array($numprepare);

                    $numship = $sql->countorder(3,$_SESSION['id']);
                    $numship=mysqli_fetch_array($numship);

                    $numshiped = $sql->countorder(4,$_SESSION['id']);
                    $numshiped=mysqli_fetch_array($numshiped);

                    $numsuccess = $sql->countorder(5,$_SESSION['id']);
                    $numsuccess=mysqli_fetch_array($numsuccess);

                    $numcancle = $sql->countorder(6,$_SESSION['id']);
                    $numcancle=mysqli_fetch_array($numcancle);
                ?>
                <input hidden type="number" id="numall" value="<?=$numnew['row_count']?>">
                <input hidden type="number" id="numnew" value="<?=$numnew['row_count']?>">
                <input hidden type="number" id="numdoing" value="<?=$numdoing['row_count']?>">
                <input hidden type="number" id="numprepare" value="<?=$numprepare['row_count']?>">
                <input hidden type="number" id="numship" value="<?=$numship['row_count']?>">
                <input hidden type="number" id="numshiped" value="<?=$numshiped['row_count']?>">
                <input hidden type="number" id="numsuccess" value="<?=$numsuccess['row_count']?>">
                <input hidden type="number" id="numcancle" value="<?=$numcancle['row_count']?>">
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#allorder" role="tab">คำสั่งซื้อทั้งหมด</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#new" role="tab">สั่งซื้อแล้ว</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#prepare" role="tab">อยู่ระหว่างเตรียมจัดส่ง</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ship" role="tab">อยู่ละหว่างขนส่ง</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shiped" role="tab">คำสั่งซื้อที่ส่งแล้ว</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#success" role="tab">คำสั่งซื้อที่สำเร็จ</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cancel" role="tab">คำสั่งซื้อที่ยกเลิก</a></li>
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
                                
								<!-- Start Single Tab -->
								<div class="tab-pane fade show active mt-4" id="allorder" role="tabpanel">
									<div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">ยอดรวมสุทธิ</th> 
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numall['row_count']>0){
                                                                            $allord = $sql->allorder($_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

								<!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="prepare" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numprepare['row_count'] > 0 || $numdoing['row_count'] > 0) {
                                                                            $allord = $sql->ordersprepare(1,2,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

                                <!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="new" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numnew['row_count']>0){
                                                                            $allord = $sql->orders(0,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

                                <!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="ship" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numship['row_count']>0){
                                                                            $allord = $sql->orders(3,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->
								
								<!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="shiped" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numshiped['row_count']>0){
                                                                            $allord = $sql->orders(4,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

                                <!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="success" role="tabpanel">
                                <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numsuccess['row_count']>0){
                                                                            $allord = $sql->orders(5,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

                                <!-- Start Single Tab -->
                                <div class="tab-pane fade mt-4" id="cancel" role="tabpanel">
                                <div class="tab-single">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-info">
                                                        <div class="tab-single">
                                                            <div class="row">
                                                                <table class="table shopping-summery">
                                                                    <thead>
                                                                        <tr class="main-hading">
                                                                            <th>รูปสินค้า</th>
                                                                            <th>สินค้า</th>
                                                                            <th class="text-center">ราคา</th>
                                                                            <th class="text-center">จำนวน</th>
                                                                            <th class="text-center">ราคารวม</th> 
                                                                            <th class="text-center">การจัดส่ง</th>
                                                                            <th class="text-center">สถานะ</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>

                                                                    <?php 
                                                                        if ($numcancle['row_count']>0){
                                                                            $allord = $sql->orders(6,$_SESSION['id']);
                                                                            while($Allord=mysqli_fetch_array($allord)){
                                                                    ?>
                                                                        <tr>
                                                                            <td class="image text-center"><a href="order_detail.php?id=<?=$Allord['id']?>"><img src="\roengrang\img/<?=$Allord['pro_img']?>"></a></td>
                                                                            <td class="product-des text-center">
                                                                                <p class="product-name"><a href="order_detail.php?id=<?=$Allord['id']?>"><?=$Allord['pro_name']?></a></p>
                                                                                <p class="product-des"><?=$Allord['shop_name']?></p>
                                                                            </td>
                                                                            <td class="price text-center"><p><?=$Allord['pro_price']?> บาท</p></td>
                                                                            <td class="amount text-center"><p><?=$Allord['ord_amount']?></p></td>
                                                                            <td class="delivery text-center">
                                                                                <p class="product-des">นอกชุมชน</p>
                                                                                <p class="product-des"><?=$Allord['sent_price']?> บาท</p>
                                                                            </td>
                                                                            <td class="total-amount text-center"><?=$Allord['total_price']?></span></td>
                                                                            <td class="status-product text-center">
                                                                                <p class="product-des">
                                                                                <?php
                                                                                    switch ($Allord['order_status']) {
                                                                                        case 0:
                                                                                            echo "ส่งคำสั่งซื้อแล้ว";
                                                                                            break;
                                                                                        case 1:
                                                                                            echo "<p>ร้านค้ารับคำสั่งซื้อ</p>";
                                                                                            echo '<p><a class="text text-danger" href="payment.php?id='.$Allord['id'].'">ชำระเงิน</a></p>';
                                                                                            break;
                                                                                        case 2:
                                                                                            echo "อยู่ระหว่างเตรียมสินค้า";
                                                                                            break;
                                                                                        case 3:
                                                                                            echo "อยู่ระหว่างขนส่ง";
                                                                                            break;
                                                                                        case 4:
                                                                                            echo "ส่งสินค้าแล้ว";
                                                                                            break;
                                                                                        case 5:
                                                                                            echo "คำสั่งซื้อเสร็จสิ้น";
                                                                                            break;
                                                                                        case 6:
                                                                                            echo "ยกเลิก";
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    <?php 
                                                                            }
                                                                        }else{
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">ไม่มีรายการ</td>
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
                                            </div><hr class="mt-3 mb-5">
                                        </div>
									</div>
								</div>
								<!--/ End Single Tab -->

							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
			
	

	
		<!-- Start Footer Area -->
        <footer class="footer">
		<!-- Footer Top -->

			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-4 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.php"><img src="images/Logo1.png" width= "20%" height="10%"></a>
							</div>
							<p class="text">
                                เว็บแอปพลิเคชันร้านค้าชุมชนเริงราง จัดทำขึ้นเนื่องด้วยวัตถุประสงค์เพื่อพัฒนาชุมชนเริงรางให้มีวิธีจัดจําหน่ายสินค้าหัตถกรรมที่เป็นเอกลักษณ์เพื่อให้สมาชิกภายใน
                                ชุมชนสามารถซื้อขายสินค้าภายในชุมชน สามารถส่งออกผ่านทางออนไลน์ และวัตถุประสงค์สําคัญเพื่อให้ชาวบ้านมี
                                รายได้เพิ่มเข้ามาหมุนเวียนภายในชุมชนมากขึ้น</p>
						</div>
						<!-- End Single Widget -->
					</div>
					
				</div>
			</div>

		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>โดยนักศึกษาคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
	
	<!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/magnific-popup.js"></script>
	<!-- Fancybox JS -->
	<script src="js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Ytplayer JS -->
	<script src="js/ytplayer.min.js"></script>
	<!-- Flex Slider JS -->
	<script src="js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>
    <?php include('scriptsearch.php');?>
</body>
</html>
<?php include('scriptcheckorder.php');?>
<?php 
    }
?>