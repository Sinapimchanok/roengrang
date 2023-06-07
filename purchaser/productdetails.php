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
            $countlikes = $sql->countlikes($pro_id);
            $Countlikes=mysqli_fetch_array($countlikes);
            $countcomment = $sql->countcomment($pro_id);
            $Countcomment=mysqli_fetch_array($countcomment);
        ?>
        <!-- Start Blog Single -->
        <section class="blog-single section">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                        <CENTER>
                        <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="\roengrang\img/<?=$Pro['pro_img']?>" style="width: 469px; height: 478px;" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" style="width: 469px; height: 478px; alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" style="width: 469px; height: 478px; alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" style="width: 469px; height: 478px; alt="#">
                                    </div>
                                </div>
                            </div>
                        <!-- End Product slider -->
                        </CENTER>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h1><?=$Pro['pro_name']?></h1>
                            <B>ร้าน <?=$Pro['shop_name']?></B>
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
                                    <a> (<?=$Countcomment['comment_count']?> รีวิว)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                </div>
                                <div class="quickview-stock">
                                    <span><a id="countlikes">ถูกใจแล้ว <?=$Countlikes['like_count']?> คน</a></span>
                                </div>
                                <div class="quickview-stock">
                                    <span><a id="likebtn"><i class="ti-heart"></i></a></span>
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
                                        <input type="text" id="quant" name="quant" class="input-number"  data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    &emsp;&emsp;<button type="button" data-toggle="modal" data-target="#report" class="btn btn-danger">รายงานสินค้า</button>
                                    
                                    <!--/ End Input Order -->
                                </div><br>
                                <div class="add-to-cart mt-3">
                                    <button class="btn" title="Add to cart" id="addcartamount<?=$TabPro['pro_id']?>" onclick="addcartamount('<?php echo $_GET['pro_id']; ?>')">เพิ่มลงในตะกร้า</button>
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
                                    <hr>
                                </div>

                                <?php
                                    if($Countcomment['comment_count']!=0){
                                ?>
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
                                <?php
                                    }
                                ?>

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
        
        <div class="modal fade" id="report" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 justify-content-center">
                                                            <div class="quickview-content justify-content-center">
                                                                <form class="form" action="update.php" method="POST" enctype="multipart/form-data">
                                                                    <input hidden type="number" name="order_status" value="<?=$Allord['order_status']?>">
                                                                    <input hidden type="number" name="id" value="<?=$Allord['id']?>">
                                                                    <div class="row justify-content-center">
                                                                        <h2>รายงานปัญหาเกี่ยวกับสินค้าที่ท่านได้รับ</h2>
                                                                    </div>
                                                                    <div class="row  mt-3">
                                                                        <div class="col-3">
                                                                            <h6>หัวข้อปัญหา </h6>
                                                                        </div>
                                                                        <br>
                                                                        <div class="col-7">
                                                                        <input type="text" class="form-control" name="topic" id="topic"  placeholder="กรุณาระบุหัวข้อของปัญหา">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-7">
                                                                            <h6>รายละเอียดปัญหาที่ท่านพบเจอ</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-9">
                                                                            <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-center mt-3">
                                                                    <button type="submit" name="reportproduct" class="btn btn-primary">รายงาน</button>
                                                                    </div>
                                                                </form>
                                                            </div>
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
							<p class="text">เว็บแอปพลิเคชันร้านค้าชุมชนเริงราง จัดทำขึ้นเนื่องด้วยวัตถุประสงค์เพื่อพัฒนาชุมชนเริงรางให้มีวิธีจัดจําหน่ายสินค้าหัตถกรรมที่เป็นเอกลักษณ์เพื่อให้สมาชิกภายใน
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

<?php 
    }
?>