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

        #เช็ค user shop
        public function usernameavailable($email) {
            $checkuser = mysqli_query($this->dbcon, "SELECT email FROM users WHERE email = '$email'");
            return $checkuser;
        }
        public function shopavailable($shop_id) {
            $checkshop = mysqli_query($this->dbcon, "SELECT user_id FROM shop WHERE shop.shop_id = '$shop_id'");
            return $checkshop;
        }
        public function usershop($user_id) {
            $usershop = mysqli_query($this->dbcon, "SELECT * FROM shop WHERE shop.user_id = '$user_id'");
            return $usershop;
        }

        # product
        public function allproduct() {
            $allpro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id ");
            return $allpro;
        }
        public function product($pro_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE products.pro_id = '$pro_id' ORDER BY products.pro_id ");
            return $pro;
        }
        public function MyProduct($shop_id) {
            $MyPro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE shop.shop_id = '$shop_id' ORDER BY products.pro_id ");
            return $MyPro;
        }
        public function products($pro_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id=shop.shop_id LEFT JOIN catagory ON products.cat_id=catagory.id WHERE pro_id='$pro_id' ");
            return $pro;
        }
        public function shop_products($shop_id) {
            $shop_pro = mysqli_query($this->dbcon, "SELECT * FROM products WHERE shop_id='$shop_id'; ");
            return $shop_pro;
        }


        public function insertProduct($shop_id, $cat_id, $pro_name, $pro_price, $pro_amount, $pro_detail, $pro_send, $fileName) {
            $insertProduct = mysqli_query($this->dbcon, "INSERT INTO products(shop_id, cat_id, pro_name, pro_price, pro_amount, pro_detail, pro_point, add_date, update_date, pro_status, pro_send, pro_img ) VALUES( '$shop_id', '$cat_id', '$pro_name', '$pro_price', '$pro_amount', '$pro_detail', '5', NOW(), NOW(), '1', '$pro_send', '$fileName' )" );
            return $insertProduct;
        }
        public function insertShop($user_id, $shop_name, $shop_detail, $fileName) {
            $insertShop = mysqli_query($this->dbcon, "INSERT INTO shop(user_id, shop_name, shop_detail, shop_img, shop_point ) VALUES( '$user_id', '$shop_name', '$shop_detail', '$fileName', '5' )" );
            return $insertShop;
        }
        public function insertOrder($cus_name,$cus_address,$cus_tel,$totalPrice) {
            $insertOrder = mysqli_query($this->dbcon, "INSERT INTO orders(ord_name, ord_addess, ord_tel, ord_totalPrice, ord_status ) VALUES( '$cus_name', '$cus_address', '$cus_tel' , '$totalPrice' , '1')");
            return $insertOrder;
        }
        public function insertOr_Detail($orderID,$pro_id,$price,$order_amount,$total) {
            $insertOr_Detail = mysqli_query($this->dbcon, "INSERT INTO orders_detail(ord_id, pro_id, order_price, order_amount, order_totalPrice  ) VALUES( '$orderID', '$pro_id', '$price', '$order_amount' , '$total' )");
            return $insertOr_Detail;
        }

        public function upPro_amount($pro_id,$order_amount) {
            $upPro_amount = mysqli_query($this->dbcon, "UPDATE products set pro_amount = pro_amount - '$order_amount' WHERE pro_id = $pro_id");
            return $upPro_amount;
        }
        public function comment($pro_id) {
            $comment = mysqli_query($this->dbcon, "SELECT * FROM comment LEFT JOIN users ON comment.user_id=users.user_id WHERE pro_id = '$pro_id'");
            return $comment;
        }

        #order
        public function order($ord_id,$shop_id) {
            $order = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.id = '$ord_id' AND shop.shop_id = '$shop_id'");
            return $order;
        }
        public function allorder($shop_id) {
            $allorder = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE shop.shop_id = '$shop_id'");
            return $allorder;
        }
        public function orderReview($shop_id) {
            $orderReview = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN users ON orders.user_id = users.user_id WHERE orders.shop_id = '$shop_id' AND review_status='1' " );
            return $orderReview;
        }
        public function orders($order_status,$shop_id) {
            $ord = mysqli_query($this->dbcon, "SELECT * FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.order_status = '$order_status' AND shop.shop_id = '$shop_id'");
            return $ord;
        }
        public function checkst($id) {
            $st = mysqli_query($this->dbcon, "SELECT order_status FROM orders WHERE orders.id = '$id'");
            return $st;
        }
        public function countorder($order_status,$shop_id) {
            $countorder = mysqli_query($this->dbcon, "SELECT COUNT(id) AS row_count FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE orders.order_status = '$order_status' AND shop.shop_id = '$shop_id'");
            return $countorder;
        }
        public function countallorder($shop_id) {
            $countallorder = mysqli_query($this->dbcon, "SELECT COUNT(id) AS row_count FROM orders LEFT JOIN products ON orders.pro_id = products.pro_id LEFT JOIN shop ON products.shop_id = shop.shop_id WHERE shop.shop_id = '$shop_id'");
            return $countallorder;
        }


        #การนับ
        public function countban($shop_id) {
            $countban = mysqli_query($this->dbcon, "SELECT COUNT(pro_id) AS row_count FROM products WHERE products.pro_ban=0 AND products.shop_id = '$shop_id'");
            return $countban;
        }
        public function countclose($shop_id) {
            $countclose = mysqli_query($this->dbcon, "SELECT COUNT(pro_id) AS row_count FROM products WHERE products.pro_amount<=5 AND products.shop_id = '$shop_id'");
            return $countclose;
        }
        public function countproducts($shop_id) {
            $countproducts = mysqli_query($this->dbcon, "SELECT COUNT(pro_id) AS row_count FROM products WHERE products.shop_id = '$shop_id'");
            return $countproducts;
        }
        #อัปเดต      
        public function update_order_status($id,$order_status) {
            $update_order_status = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' WHERE orders.id='$id'");
            return $update_order_status;
        }
        public function update_pro_status($st_full,$pro_id) {
            $update_pro_status = mysqli_query($this->dbcon, "UPDATE products SET pro_status = '$st_full' WHERE products.pro_id='$pro_id'");
            return $update_pro_status;
        }
        public function update_product($pro_id, $cat_id, $pro_name, $pro_price, $pro_amount, $pro_detail, $pro_send, $fileName) {
            $update_product = mysqli_query($this->dbcon, "UPDATE products SET cat_id = '$cat_id',pro_name = '$pro_name',pro_price = '$pro_price',pro_amount = '$pro_amount',pro_detail = '$pro_detail',update_date = NOW(),pro_send = '$pro_send',pro_img = '$fileName' WHERE pro_id='$pro_id'");
            return $update_product;
        }
        public function update_order_status0($id,$order_status,$sentprice) {
            $update_order_status0 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,sent_price = '$sentprice',confirm_date = NOW() WHERE orders.id='$id'");
            return $update_order_status0;
        }
        public function update_order_status2($id,$order_status,$ship_img) {
            $update_order_status2 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,ship_date = NOW() ,ship_img = '$ship_img' WHERE orders.id='$id'");
            return $update_order_status2;
        }
        public function update_order_status3($id,$order_status,$sent_img,$payment_img) {
            $update_order_status3 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,sent_date = NOW() ,sent_img = '$sent_img',payment_img = '$payment_img',payment_status = '1' WHERE orders.id='$id'");
            return $update_order_status3;
        }
        public function update_order_status6($id,$order_status,$cancleReason) {
            $update_order_status6 = mysqli_query($this->dbcon, "UPDATE orders SET order_status = '$order_status' ,cancleReason = '$cancleReason',cancle_date = NOW() WHERE orders.id='$id'");
            return $update_order_status6;
        }

        #การเงิน
        public function thisweekp($shop_id) {
            $thisweekp = mysqli_query($this->dbcon, "SELECT DATE_FORMAT(add_date, '%W') AS day_of_week, SUM(pro_price) AS total_price FROM products WHERE WEEK(add_date) = WEEK(NOW()) GROUP BY DAYOFWEEK(add_date);");
            return $thisweekp;
        }
        public function lastweekp($shop_id) {
            $lastweekp = mysqli_query($this->dbcon, "SELECT DATE_FORMAT(add_date, '%W') AS day_of_week, SUM(pro_price) AS total_price FROM products WHERE WEEK(add_date) = WEEK(DATE_SUB(NOW(), INTERVAL 1 WEEK)) GROUP BY DAYOFWEEK(add_date);");
            return $lastweekp;
        }
        public function yeartotal($shop_id) {
            $yeartotal = mysqli_query($this->dbcon, "SELECT SUM(CASE WHEN WEEK(ord_date) = WEEK(CURRENT_DATE()) THEN total_price ELSE 0 END) AS total_week, SUM(CASE WHEN YEAR(ord_date) = YEAR(CURRENT_DATE()) THEN total_price ELSE 0 END) AS total_year FROM orders WHERE shop_id='$shop_id';");
            return $yeartotal;
        }

        #ลบ-------------------------------------------------------------------------------
        public function delete_products($pro_id) {
            $delete_cart = mysqli_query($this->dbcon, "DELETE FROM cart WHERE pro_id='$pro_id'");
            $delete_comment = mysqli_query($this->dbcon, "DELETE FROM comment WHERE pro_id='$pro_id'");
            $delete_com_reply = mysqli_query($this->dbcon, "DELETE FROM com_reply WHERE pro_id='$pro_id'");
            $delete_report_pro = mysqli_query($this->dbcon, "DELETE FROM report_pro WHERE pro_id='$pro_id'");
            $delete_products = mysqli_query($this->dbcon, "DELETE FROM products WHERE pro_id='$pro_id'");
            return $delete_cart;
            return $delete_comment;
            return $delete_com_reply;
            return $delete_report_pro;
            return $delete_products;
        }
        public function delete_shop($shop_id) {
            $delete_report_shop = mysqli_query($this->dbcon, "DELETE FROM report_shop WHERE shop_id='$shop_id'");
            $delete_shop = mysqli_query($this->dbcon, "DELETE FROM shop WHERE shop_id='$shop_id'");
            return $delete_pro_shop;
            return $delete_shop;
        }

        #เรียกร้านค้า
        public function shop($shop_id) {
            $shop = mysqli_query($this->dbcon, "SELECT * FROM shop LEFT JOIN users ON shop.user_id=users.user_id WHERE shop_id='$shop_id' ");
            return $shop;
        }
    }

?>