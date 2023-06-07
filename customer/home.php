<?php 
    session_start();
    include_once('functions.php'); 
    include_once('layout.php'); 
    include_once('include/nav.php'); 

    if ($_SESSION['id'] == "") {
        header("location: index.php");
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านค้าชุมชนเริงราง</title>
</head>
<body>

        <div class="container px-4 px-lg-5 mt-5">
                
                <div class="card p-2 mb-5">
                    <h3 class="text-dark">หมวดหมู่</h3>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card p-2" ALIGN="center">
                                <a class="text-dark text-decoration-none" href="#">เครื่องดื่ม</a>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="row gx-2 gx-lg-2 row-cols-2 row-cols-md-3 row-cols-xl-5 justify-content-center">

                <?php
                    $product = new DB_con();

                    $allproduct = $product->allproduct();
                    while($allpro=mysqli_fetch_array($allproduct)){
                    ?>
                        <div class="col mb-3">
                            <div class="card h-100">
                                <?php   if($allpro['pro_send']==0) {    ?>
                                <!-- Sale badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">ส่งเฉพาะภายในชุมชน</div>
                                <?php } ?>
                                <!-- Product image-->
                                <img class="card-img-top" src="\roengrang\img/<?=$allpro['pro_img']?>" width="100%" height="200px" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?=$allpro['pro_name']?></h5>
                                        <!-- Product price-->
                                        <?=$allpro['pro_price']?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="product.php?pro_id=<?=$allpro['pro_id']?>">ดูสินค้า</a></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                ?>

                
            </div>
        </div>

</body>
</html>


<?php 
    }
?>
    