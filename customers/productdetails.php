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
		

    if ($_SESSION['user_role'] != 3) {
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
                            <!-- Search Form -->
                            <div class="search-top">
                                <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                                <!-- Search Form -->
                                <div class="search-top">
                                    <form class="search-form">
                                        <input type="text" placeholder="Search here..." name="search">
                                        <button value="search" type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                                <!--/ End Search Form -->
                            </div>
                            <!--/ End Search Form -->
                            <div class="mobile-nav"></div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <div class="search-bar-top">
                                <div class="search-bar">
                                    <select>
                                        <option selected="selected">หมวดหมู่ทั้งหมด</option>
										<?php
											$cat = $sql->catagory();
                                            while($Cat=mysqli_fetch_array($cat)){
                                        ?>
                                        <option><?=$Cat['cat_name']?></option>
										<?php
											}
										?>
                                    </select>
                                    <form>
                                        <input name="search" placeholder="ค้นหาสินค้าที่นี่....." type="search">
                                        <button class="btnn"><i class="ti-search"></i></button>
                                    </form>
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
                                <?php 
										if ($RS[0]>0){
									?>
									<a  class="single-icon"><i class="ti-shopping-cart-full"></i> <span class="total-count"><?=$row?></span></a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span><?=$row?> รายการ</span>
                                            <a href="cart.php">ดูตะกร้า</a>
                                        </div>
                                        <ul class="shopping-list">
											<?php
												while($Cart=mysqli_fetch_array($cart)){
											?>
                                            <li>
                                                <a href="deletecart.php?cart_id=<?=$Cart['amount']?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="product.php?pro_id=<?=$Cart['pro_id']?>"><img src="\roengrang\img/<?=$Cart['pro_img']?>" alt="#"></a>
                                                <h4><a href="product.php?pro_id=<?=$Cart['pro_id']?>"><?=$Cart['pro_name']?></a></h4>
                                                <p class="quantity"><?=$Cart['amount']?> - <span class="amount"><?=$Cart['price']?> บาท</span></p>
                                            </li>
											<?php
												}
											?>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>รวม</span>
                                                <span class="total-amount"><?=$RS['total']?> บาท</span>
                                            </div>
                                            <a href="checkout.php" class="btn animate">ชำระเงิน</a>
                                        </div>
                                    </div>
									<?php 
										}else{
									?>
									<a class="single-icon"><i class="ti-shopping-cart-full"></i> <span class="total-count"><?=$row?></span></a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>0 รายการ</span>
                                            <a href="cart.php">ดูตะกร้า</a>
                                        </div>
                                        <ul class="shopping-list text-center">
                                            <li>
                                                <a>ไม่มีรายการ</a> 
                                            </li>
                                        </ul>
                                    </div>
									<?php
										}
									?>
                                    <!--/ End Shopping Item -->

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
                                                        <li><a href="index.php">หน้าหลัก</a></li>
                                                        <li class="active"><a>สินค้า</a></li>	
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
                                                        <li><a href="allorder.php">รายการสั่งซื้อ</a></li>
                                                        <li><a href="contact.php">เกี่ยวกับเรา</a></li>
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
                                <li><a href="allproduct.php">สินค้าทั้งหมด<i class="ti-arrow-right"></i></a></li>
                                <li class="active"><a>สินค้า</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
            
        <?php
            $pro_id = $_GET['pro_id'];
            $pro = $sql->product($pro_id);
            $Pro=mysqli_fetch_array($pro);
        ?>
        <!-- Start Blog Single -->
        <section class="blog-single section">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="\roengrang\img/<?=$Pro['pro_img']?>" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                </div>
                            </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h1><?=$Pro['pro_name']?></h1>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                    <?php
                                    switch ($Pro['pro_point']) {
                                        case 1:
                                    ?>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php
                                            break;
                                        case 2:
                                    ?>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php
                                            break;
                                        case 3:
                                    ?>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php
                                            break;
                                        case 4:
                                    ?>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php
                                            break;
                                        case 5:
                                    ?>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                    <?php
                                            break;
                                    }
                                    ?>
                                    </div>
                                    <a href="#"> (1 customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                </div>
                                <div class="quickview-stock">
                                    <span><a href="#"><i class="ti-heart"></i></a></span>
                                </div>
                            </div>
                            <h3><?=$Pro['pro_price']?> บาท</h3>
                            <form method="POST">
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant" class="input-number"  data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div><br>
                                <div class="add-to-cart mt-3">
                                    <input class="btn" type="button" value="เพิ่มลงในตะกร้า" onClick="this.form.action='addcart.php?pro_id=<?=$Pro['pro_id']?>'; submit()">
                                    <input class="btn" type="button" value="ซื้อสินค้า" onClick="this.form.action='checkout.php?pro_id=<?=$Pro['pro_id']?>'; submit()">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="blog-single-main">
                            <div class="row">
                                <div class="col-12">
                                    <div class="blog-detail">
                                        <h4 class="mb-2">รายละเอียด</h4>
                                        <div class="content">
                                            <p><?=$Pro['pro_detail']?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12">
                                    <div class="comments">
                                        <h3 class="comment-title">ความคิดเห็น</h3>
                                        <?php
                                            $com = $sql->comment($pro_id);
                                            while($Com=mysqli_fetch_array($com)){
                                        ?>
                                        <!-- Single Comment -->
                                        <div class="single-comment">
                                            <img src="\roengrang\img/<?=$Com['user_img']?>">
                                            <div class="content">
                                                <h4><?=$Com['user_fullname']?> <span><?=$Com['com_date']?></span></h4>
                                                <p><?=$Com['com_detail']?></p>
                                                <div class="button">
                                                    <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Comment -->
                                            <?php
                                                $Rep = $sql->reply($Com['id']);
                                                while($rep=mysqli_fetch_array($Rep)){
                                            ?>
                                            <!-- Single Comment -->
                                            <div class="single-comment left">
                                                <img src="\roengrang\img/<?=$rep['user_img']?>">
                                                <div class="content">
                                                    <h4><?=$rep['user_fullname']?> <span><?=$rep['comReply_date']?></span></h4>
                                                    <p><?=$rep['comReply_detail']?></p>
                                                    <div class="button">
                                                        <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Comment -->
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>                                  
                                </div>                                          
                                <div class="col-12">            
                                    <div class="reply">
                                        <div class="reply-head">
                                            <h2 class="reply-title">แสดงความคิดเห็น</h2>
                                            <!-- Comment Form -->
                                            <form class="form" action="#">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>เขียนความคิดเห็น<span>*</span></label>
                                                            <textarea name="message" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group button">
                                                            <button type="submit" class="btn">โพสต์</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- End Comment Form -->
                                        </div>
                                    </div>          
                                </div>          
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="main-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget recent-post">
                                <h3 class="title">สินค้าอื่นจากทางร้าน</h3>
                                <?php
                                    $Shoppro = $sql->shoppro($Pro['shop_id']);
                                    while($shoppro=mysqli_fetch_array($Shoppro)){
                                ?>
                                <!-- Single Post -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="\roengrang\img/<?=$shoppro['pro_img']?>">
                                    </div>
                                    <div class="content">
                                        <h5><a href="productdetails.php?pro_id=<?=$shoppro['pro_id']?>"><?=$shoppro['pro_name']?></a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>Jan 11, 2020</li>
                                            <li><i class="fa fa-commenting-o" aria-hidden="true"></i>35</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                                <?php
                                    }
                                ?>
                                <!-- Single Post -->
                                <div class="single-widget mt-3" style="display: flex; justify-content: center;">
                                    <div class="btn">
                                        <a href="shopdetails.php?shop_id=<?=$Pro['shop_id']?>">ดูร้านค้า</a>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ End Blog Single -->
            
        <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo2.png" alt="#"></a>
                            </div>
                            <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
                            <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Customer Service</h4>
                            <ul>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Get In Tuch</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>NO. 342 - London Oxford Street.</li>
                                    <li>012 United Kingdom.</li>
                                    <li>info@eshop.com</li>
                                    <li>+032 3456 7890</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-flickr"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
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
                                <p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right">
                                <img src="images/payments.png" alt="#">
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
</body>
</html>

<?php 
    }
?>