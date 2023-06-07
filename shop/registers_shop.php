<?php 
    session_start();
    include_once('functions.php'); 

    $sql = new DB_con();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;600&display=swap" rel="stylesheet">
    <seta http-equiv="X-UA-Compatible" content="IE=edge">
    <mcript src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js.js" type="text/javascript"></script>
    <style>
        .avatar {
          vertical-align: middle;
          width: 200px;
          height: 200px;
          border-radius: 200%;
          }
        body{
          font-family: 'IBM Plex Sans Thai', sans-serif;
          }
    </style>
  </head>
  <body>
    <section class="vh-100" style="background-image: linear-gradient(125deg,#3498db,#1abc9c);">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-md-9 col-lg-7 col-xl-10">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-4">
                <div class="d-flex text-black">
                  <form class="form" action="shop_upload.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      
                  
                              <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php 
                                        echo $_SESSION['statusMsg']; 
                                        unset($_SESSION['statusMsg']);
                                    ?>
                                </div>
                              <?php } ?>
                              <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-3 mt-4">สมัครร้านค้าชุมชนเริงราง</p>

                              <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6">
                                    <CENTER>
                                    <div class="col-md-9">
                                        <img class="card-img mb-5 mb-md-0" id="blah" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" height="380px" />
                                    </div>
                                    </CENTER>
                                    <CENTER>
                                    <div class="col-md-7">
                                        <input type="file" class="form-control mt-3" name="file" id="file" onchange="readURL(this); " accept="image/*" />
                                    </div>
                                    </CENTER>
                                </div>
                                <div class="col-md-6">
                                  
                                  <div class="form-floating mb-3">
                                      <input class="form-control" id="shop_name" name="shop_name" type="text" placeholder="ชื่อร้านค้า" />
                                      <label for="shop_name">ชื่อร้านค้า<span class="text-danger"> * ไม่ต้องเติมคำว่า "ร้าน" หรือ "ร้านค้า" นำหน้า</span></label>
                                  </div>                    
                                  
                                  <div class="form-floating mb-3">
                                      <textarea class="form-control" id="shop_detail" name="shop_detail" placeholder="รายละเอียด"></textarea>
                                      <label for="shop_detail">รายละเอียดร้านค้า<span class="text-danger"> * ไม่เกิน ๕๐๐ ตัวอักษร</span></label>
                                  </div>
                                  
                                  <p class="mt-3" ALIGN="center" >
                                      <button type="submit" name="addShop" class="btn btn-primary">สมัครขายสินค้า</button>
                                  </p>
                                </div>
                        
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  
<?php include('script.php');?>