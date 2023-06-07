<?php 
    session_start();
    include_once('functions.php'); 
    
    $userdata = new DB_con();

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $result = $userdata->signin($email, $password);
        $num = mysqli_fetch_array($result);

        if ($num > 0) {
            $_SESSION['id'] = $num['user_id'];
            $_SESSION['fname'] = $num['user_fullname'];
            $_SESSION['user_role'] = $num['user_role'];
            if ($_SESSION['user_role'] == '1') {
              echo "<script>window.location.href='admin/index.php'</script>";
            }
            elseif ($_SESSION['user_role'] == '2') {
              echo "<script>window.location.href='purchaser/index.php'</script>";
            }
            elseif ($_SESSION['user_role'] == '3') {
              echo "<script>window.location.href='customers/index.php'</script>";
              
            }
            else {
              echo "<script>alert('คำร้องของคุณยังไม่ได้รับการยื่นยัน');</script>";
              echo "<script>window.location.href='wait.php'</script>";
            }
        } else {
            echo "<script>alert('Something went wrong! Please try again.');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel ="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@500;600&display=swap" rel="stylesheet">
    <style>
      body{
        font-family: 'IBM Plex Sans Thai', sans-serif;
      }
    </style>
</head>

  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://res.cloudinary.com/dlne5j5ub/image/upload/v1686072817/logo1_fo37mz.png" width= "90%" height="60%"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-5 col-xl-3">
          <form method="post">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-1 mt-4">เข้าสู่ระบบ</p>
            </div>
          
              <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['statusMsg']; 
                        unset($_SESSION['statusMsg']);
                    ?>
                </div>
              <?php } ?>

            <!-- Email input -->
            <div class="form-outline mb-4">
            <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="กรุณากรอกอีเมล">
                    <span id="emailavailable"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน">
            </div>

            <br>
            <div class="col-md-12 text-center">
              <button type="submit" name="login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">ไม่มีบัญชีใช่หรือไม่? 
                <a href="registers.php" class="link-danger">สมัครเลย</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
</body>
</html>