<?php 

    include_once('../cloudinary/index.php');
    define('DB_SERVER', 'localhost'); // Your hostname
    define('DB_USER', 'root'); // Database Username
    define('DB_PASS', ''); // Database Password
    define('DB_NAME', 'roengrang'); // Database Name

    class DB_con {
        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }

        public function orID() {
            $orID = mysqli_insert_id($this->dbcon);
            return $orID;
        }

        public function usernameavailable($email) {
            $checkuser = mysqli_query($this->dbcon, "SELECT email FROM users WHERE email = '$email'");
            return $checkuser;
        }

        public function usershop($user_id) {
            $usershop = mysqli_query($this->dbcon, "SELECT shop_id,shop_name FROM shop WHERE user_id = '$user_id'");
            return $usershop;
        }

        public function registration($fname, $uname, $uemail, $password) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO users(fullname, username, useremail, password) VALUES('$fname', '$uname', '$uemail', '$password')");
            return $reg;
        }

        public function signin($email, $password) {
            $signinquery = mysqli_query($this->dbcon, "SELECT user_id, fullname FROM users WHERE email = '$email' AND password = '$password'");
            return $signinquery;
        }

        #เรียกสินค้า
        public function allproduct() {
            $allpro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id ");
            return $allpro;
        }
        public function product($pro_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.pro_id = '$pro_id' ORDER BY products.pro_id ");
            return $pro;
        }
        public function productcat($cat_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.cat_id = '$cat_id' ORDER BY products.pro_id ");
            return $pro;
        }
        public function searchproduct($search) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.pro_name LIKE '%$search%' ORDER BY products.pro_id;");
            return $pro;
        }
        public function searchproductcat($cat,$search) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.cat_id = '$cat' AND products.pro_name LIKE '%$search%' ORDER BY products.pro_id;");
            return $pro;
        }
        public function searchshop($search) {
            $searchshop = mysqli_query($this->dbcon, "SELECT * FROM shop WHERE shop.shop_name LIKE '%$search%' ORDER BY shop.shop_id LIMIT 2;");
            return $searchshop;
        }
        public function allsearchshop($search) {
            $searchshop = mysqli_query($this->dbcon, "SELECT * FROM shop WHERE shop.shop_name LIKE '%$search%' ORDER BY shop.shop_id;");
            return $searchshop;
        }
        public function shoppro($shop_id) {
            $shoppro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.shop_id = '$shop_id' ORDER BY RAND() LIMIT 5");
            return $shoppro;
        }
        public function shopproduct($shop_id) {
            $shopproduct = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.shop_id = '$shop_id' ORDER BY RAND()");
            return $shopproduct;
        }
        public function productlike($user_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.pro_id = '$pro_id' ORDER BY products.pro_id ");
            return $pro;
        }
        public function tabproduct($cat_id) {
            $tabpro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE cat_id='$cat_id' ORDER BY RAND() LIMIT 8 ");
            return $tabpro;
        }
        public function taballproduct() {
            $taballproduct = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id ORDER BY RAND() LIMIT 8 ");
            return $taballproduct;
        }
        public function bestselled() {
            $bestselled = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id ORDER BY products.pro_selled DESC LIMIT 12 ");
            return $bestselled;
        }
        public function likes($user_id) {
            $likes = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id LEFT JOIN likes ON products.pro_id = likes.pro_id WHERE likes.user_id = $user_id;");
            return $likes;
        }
        public function countlikes($pro_id) {
            $countlikes = mysqli_query($this->dbcon, "SELECT COUNT(likes.user_id) AS like_count FROM likes JOIN products ON likes.pro_id = products.pro_id WHERE products.pro_id = $pro_id;");
            return $countlikes;
        }
        public function likescount($user_id,$pro_id) {
            $likes = mysqli_query($this->dbcon, "SELECT count(id) AS count FROM likes WHERE likes.user_id = $user_id AND likes.pro_id = $pro_id;");
            return $likes;
        }

        #ร้านค้า
        public function shop($shop_id) {
            $shop = mysqli_query($this->dbcon, "SELECT * FROM shop WHERE shop.shop_id = '$shop_id'");
            return $shop;
        }

        #คอมเมนท์
        public function comment($pro_id) {
            $comment = mysqli_query($this->dbcon, "SELECT * FROM comment LEFT JOIN users ON comment.user_id=users.user_id WHERE comment.pro_id = '$pro_id'");
            return $comment;
        }
        public function reply($com_id) {
            $rep = mysqli_query($this->dbcon, "SELECT * FROM com_reply LEFT JOIN users ON com_reply.user_id=users.user_id WHERE com_reply.com_id = '$com_id' ");
            return $rep;
        }
        public function countcomment($pro_id) {
            $countcomment = mysqli_query($this->dbcon, "SELECT COUNT(comment.id) AS comment_count FROM comment WHERE comment.pro_id = $pro_id;");
            return $countcomment;
        }

        #ตะกร้า
        public function cart($user_id) {
            $cart = mysqli_query($this->dbcon, "SELECT *,products.pro_price*products.pro_id as price FROM cart LEFT JOIN products ON cart.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE cart.user_id = '$user_id'");
            return $cart;
        }
        public function rowsum($user_id) {
            $rs = mysqli_query($this->dbcon, "SELECT COUNT(products.pro_price*products.pro_id) as count,SUM(products.pro_price*products.pro_id) as total FROM cart LEFT JOIN products ON cart.pro_id = products.pro_id WHERE cart.user_id = '$user_id'");
            return $rs;
        }
        public function deletecart($cart_id) {
            $delcart = mysqli_query($this->dbcon, "DELETE FROM cart WHERE cart.id='$cart_id'");
            return $delcart;
        }
        public function wherecart($pro_id,$user_id) {
            $wherecart = mysqli_query($this->dbcon, "SELECT * FROM cart WHERE cart.pro_id = '$pro_id' AND cart.user_id = '$user_id'");
            return $wherecart;
        }

        #เรียกหมวดหมู่
        public function catagory() {
            $cat = mysqli_query($this->dbcon, "SELECT * FROM catagory");
            return $cat;
        }

        #ที่อยู่
        public function useraddress($user_id) {
            $address = mysqli_query($this->dbcon, "SELECT * FROM user_address WHERE user_id='$user_id'" );
            return $address;
        }
        
        #ออร์เดอร์
        public function allorder($user_id) {
            $allord = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.user_id = '$user_id'");
            return $allord;
        }
        public function rowor($user_id) {
            $rowor = mysqli_query($this->dbcon, "SELECT COUNT(*) as rowor FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id WHERE orders.user_id = '$user_id'");
            return $rowor;
        }
        public function checkst($id) {
            $st = mysqli_query($this->dbcon, "SELECT order_status FROM orders WHERE orders.id = '$id'");
            return $st;
        }
        public function order($ord_id) {
            $order = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.id = '$ord_id'");
            return $order;
        }
        public function orderproduct($pro_id) {
            $orderproduct = mysqli_query($this->dbcon, "SELECT * FROM orders  WHERE orders.pro_id = '$pro_id'");
            return $orderproduct;
        }
        public function countallorder($user_id) {
            $countallorder = mysqli_query($this->dbcon, "SELECT COUNT(id) AS row_count FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.user_id = '$user_id'");
            return $countallorder;
        }
        public function countorder($order_status,$user_id) {
            $countorder = mysqli_query($this->dbcon, "SELECT COUNT(id) AS row_count FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.order_status = '$order_status' AND orders.user_id = '$user_id'");
            return $countorder;
        }
        public function orders($order_status,$user_id) {
            $ord = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.order_status = '$order_status' AND orders.user_id = '$user_id'");
            return $ord;
        }
        public function ordersprepare($order_status1,$order_status2,$user_id) {
            $ord = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.order_status = '$order_status1' OR orders.order_status = '$order_status2' AND orders.user_id = '$user_id'");
            return $ord;
        }
        public function point($pro_id) {
            $point = mysqli_query($this->dbcon, "SELECT AVG(ord_point) as points FROM orders WHERE orders.pro_id='$pro_id'");
            return $point;
        }
        

        #insert
        public function addorders($pro_id,$shop_id,$user_id,$ord_name,$ord_amount,$sumprice,$sentprice,$totalprice,$ord_tel,$ord_location,$ord_address,$ord_road,$ord_soi,$ord_province,$ord_district,$ord_subdistrict,$ord_postID,$ord_note,$payment,$pro_amount,$pro_selled) {
            $addorders = mysqli_query($this->dbcon, "INSERT INTO orders(pro_id,shop_id,user_id,ord_name,ord_amount,sum_price,sent_price,total_price,ord_tel,ord_location,ord_address,ord_road,ord_soi,ord_province,ord_district,ord_subdistrict,ord_postID,ord_note,payment) VALUES('$pro_id','$shop_id','$user_id','$ord_name','$ord_amount','$sumprice','$sentprice','$totalprice','$ord_tel','$ord_location','$ord_address','$ord_road','$ord_soi','$ord_province','$ord_district','$ord_subdistrict','$ord_postID','$ord_note','$payment')");
            $upamount = mysqli_query($this->dbcon, "UPDATE products SET pro_amount = '$pro_amount',pro_selled = '$pro_selled' WHERE products.pro_id='$pro_id'");
            return $addorders;
            return $upamount;
        }
        public function addlike($pro_id,$user_id) {
            $addlike = mysqli_query($this->dbcon, "INSERT INTO likes(pro_id,user_id) VALUES('$pro_id','$user_id')");
            return $addlike;
        }
        public function addcart($pro_id,$user_id,$amount) {
            $addcart = mysqli_query($this->dbcon, "INSERT INTO cart(pro_id,user_id,amount) VALUES('$pro_id','$user_id','$amount')");
            return $addcart;
        }
        public function reportproduct($fname, $uname, $uemail, $password) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO report_pro(fullname, username, useremail, password) VALUES('$fname', '$uname', '$uemail', '$password')");
            return $reg;
        }

        #update
        public function update_order_status($id,$order_status) {
            $update_order_status = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' WHERE orders.id='$id'");
            return $update_order_status;
        }
        public function update_order_status1($id,$order_status) {
            $update_order_status1 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status',doing_date = NOW() WHERE orders.id='$id'");
            return $update_order_status1;
        }
        public function update_order_status6($id,$order_status,$cancleReason) {
            $update_order_status6 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,cancleReason = '$cancleReason',cancle_date = NOW() WHERE orders.id='$id'");
            return $update_order_status6;
        }
        public function updatecart($pro_id,$user_id,$amount) {
            $updatecart = mysqli_query($this->dbcon, "UPDATE cart SET amount = '$amount' WHERE cart.pro_id='$pro_id' AND cart.user_id='$user_id'");
            return $updatecart;
        }
        public function update_order_status4($id,$order_status,$receive_imgName,$paymentUser_img) {
            $update_order_status4 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,receive_date = NOW() ,recieve_img = '$receive_imgName',paymentUser_img = '$paymentUser_img',payment_status = '1' WHERE orders.id='$id'");
            return $update_order_status4;
        }
        public function review($id,$ord_point,$review,$pro_id) {
            $review = mysqli_query($this->dbcon, "UPDATE orders SET ord_point = '$ord_point' ,review = '$review' ,review_status = '1'WHERE orders.id='$id'");
            $pro = mysqli_query($this->dbcon, "UPDATE products SET pro_point = '$ord_point' WHERE products.pro_id='$pro_id'");
            return $review;
            return $pro;
        }

        #delete
        public function unlike($pro_id,$user_id) {
            $unlike = mysqli_query($this->dbcon, "DELETE FROM likes WHERE likes.pro_id='$pro_id' AND likes.user_id='$user_id'");
            return $unlike;
        }

    }

?>