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
	
	<!-- Start Product Area -->
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="tab-single">
								<div class="row">
									<?php
										$allpro = $sql->likes($_SESSION['id']);
										$row = mysqli_fetch_row($allpro);
                                    	if($row>=1){
                                            $ok = $sql->likes($_SESSION['id']);
											while($Allpro=mysqli_fetch_array($ok)){
                                                $product_id = $Allpro['pro_id'];
                                    ?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="productdetails.php?pro_id=<?=$Allpro['pro_id']?>">
                                                        <img class="default-img" src="\roengrang\img/<?=$Allpro['pro_img']?>"  width="auto" height="200px" >
                                                        <img class="hover-img" src="\roengrang\img/<?=$Allpro['pro_img']?>" width="auto" height="200px" >
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                            <?php
                                                                $LIKE = $sql->likescount($_SESSION['id'],$product_id);
                                                                $like=mysqli_fetch_array($LIKE)	;
                                                                if($like['count']==1){
                                                            ?>
                                                                <a title="ยกเลิกถูกใจสินค้า" id="Like<?=$Allpro['pro_id']?>" onclick="unlikes('<?php echo $product_id; ?>')"><i class="fa fa-heart "></i><span>ยกเลิกถูกใจสินค้า</span></a>
                                                            <?php	
                                                                }else{				
                                                            ?>
                                                                <a title="ถูกใจสินค้า" id="Like<?=$Allpro['pro_id']?>" onclick="likes('<?php echo $product_id; ?>')"><i class=" ti-heart "></i><span>ถูกใจสินค้า</span></a>
                                                            <?php	
                                                                }			
                                                            ?>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <a title="Add to cart" href="addcart.php?pro_id=<?=$Allpro['pro_id']?>">เพิ่มลงในตะกร้า</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="productdetails.php?pro_id=<?=$Allpro['pro_id']?>"><?=$Allpro['pro_name']?></a></h3>
                                                    <div class="product-price">
                                                        <span><?=$Allpro['pro_price']?> บาท</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									<?php
										}
									}else{
									?>
										<div class="col-12 mt-5">
											<center>
                                                <div class="m-5">
                                                    <?=$row?>
                                                    <h3>...คุณยังไม่มีสินค้าที่ถูกใจ...</h3>
                                                </div>
                                            </center>
										</div>
                                    <?php
                                    }
									?>
								</div>
							</div>
						</div>
					</div>
				</div><hr class="mt-5 mb-5">
            </div>
			
	<!-- End Product Area -->
	
	<!-- Start Footer Area -->
	<footer class="footer mt-6">
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
								รายได้เพิ่มเข้ามาหมุนเวียนภายในชุมชนมากขึ้น
							</p>
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
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
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
    <script>
        function likes(productId) {
			var button = document.getElementById('Like' + productId);
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,function:'addlike' },
                success: function(response) {
					if(response==productId){
					button.innerHTML = '<i class="fa fa-heart"></i><span>ยกเลิกถูกใจสินค้า</span>';
					button.setAttribute('title', 'ยกเลิกกดถูกใจ');
					button.setAttribute('onclick', "unlikes('" + productId + "')");
                    alert("likeProduct " + productId + "");
					}
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred. Please try again later.");
                }
            });
        }
		function unlikes(productId) {
			var button = document.getElementById('Like' + productId);
            $.ajax({
                url: "ajax_db.php",
                type: "POST",
                data: { product_id: productId,function:'unlike'},
                success: function(response) {
					if(response==productId){
						button.innerHTML = '<i class="ti-heart"></i><span>ถูกใจสินค้า</span>';
						button.setAttribute('title', 'กดถูกใจ');
						button.setAttribute('onclick', "likes('" + productId + "')");
						alert("unlikeProduct " + productId + " ");
					}
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred. Please try again later.");
                }
            });
        }
    </script>
</body>
</html>

<?php 
    }
?>