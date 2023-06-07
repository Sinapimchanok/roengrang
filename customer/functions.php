<?php 

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
            $usershop = mysqli_query($this->dbcon, "SELECT shop_id FROM shop WHERE user_id = '$user_id'");
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

        public function allproduct() {
            $allpro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id ");
            return $allpro;
        }

        public function product($pro_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.pro_id = '$pro_id' ORDER BY products.pro_id ");
            return $pro;
        }

        public function insertOrder($cus_name,$cus_address,$cus_tel,$totalPrice) {
            $insertOrder = mysqli_query($this->dbcon, "INSERT INTO orders(ord_name, ord_addess, ord_tel, ord_totalPrice, ord_status ) VALUES( '$cus_name', '$cus_address', '$cus_tel' , '$totalPrice' , '1')");
            return $insertOrder;
        }

        public function insertOr_Detail($orderID,$pro_id,$price,$order_amount,$total) {
            $insertOr_Detail = mysqli_query($this->dbcon, "INSERT INTO orders_detail(ord_id, pro_id, order_price, order_amount, order_totalPrice  ) VALUES( '$orderID', '$pro_id', '$price', '$order_amount' , '$total' )");
            return $insertOr_Detail;
        }

        public function order($ord_id) {
            $order = mysqli_query($this->dbcon, "SELECT * FROM orders WHERE orders.ord_id = '$ord_id'");
            return $order;
        }

        public function orderDetail($ord_id) {
            $order = mysqli_query($this->dbcon, "SELECT * FROM orders WHERE orders.ord_id = '$ord_id'");
            return $order;
        }

        public function comment($pro_id) {
            $comment = mysqli_query($this->dbcon, "SELECT * FROM comment LEFT JOIN users ON comment.user_id=users.user_id WHERE pro_id = '$pro_id'");
            return $comment;
        }
    }

?>