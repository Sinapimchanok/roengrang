<?php 
    
    include_once('../cloudinary/index.php'); 
    define('DB_SERVER', 'localhost'); // Your hostname
    define('DB_USER', 'root'); // Database Username
    define('DB_PASS', ''); // Database Password
    define('DB_NAME', 'roengrang'); // Database Name
    date_default_timezone_set('Asia/Bangkok');

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

        public function useremailavailable($email) {
            $checkemail = mysqli_query($this->dbcon, "SELECT user_email FROM users WHERE user_email = '$email'");
            return $checkemail;
        }

        public function signin($email, $password) {
            $signinquery = mysqli_query($this->dbcon, "SELECT user_id, user_fullname ,user_role FROM users WHERE user_email = '$email' AND user_password = '$password'");
            return $signinquery;
        }

        #ที่อยู่
        public function province() {
            $province = mysqli_query($this->dbcon, "SELECT * FROM provinces ");
            return $province;
        }
        public function district($id) {
            $district = mysqli_query($this->dbcon, "SELECT * FROM district WHERE province_code=$id");
            return $district;
        }
        public function subdistrict($id) {
            $subdistrict = mysqli_query($this->dbcon, "SELECT * FROM subdistrict WHERE district_code=$id");
            return $subdistrict;
        }
        public function zip_code($id) {
            $zip_code = mysqli_query($this->dbcon, "SELECT * FROM subdistrict WHERE code=$id");
            return $zip_code;
        }
        public function address($sub_id) {
            $address = mysqli_query($this->dbcon, "SELECT subdistrict.name_th as subdistrict_name,district.name_th  as district_name,provinces.name_th  as provinces_name,zip_code FROM subdistrict  LEFT JOIN district ON subdistrict.district_code=district.code LEFT JOIN provinces ON district.province_code=provinces.code WHERE subdistrict.code='$sub_id'");
            return $address;
        }
        public function useraddress($user_id) {
            $address = mysqli_query($this->dbcon, "SELECT * FROM user_address WHERE user_id='$user_id' AND address_role='บ้าน'" );
            return $address;
        }

        // ----------------------------------------------------------------------------------------------------------------------------------------

        #เรียกรายงาน
        public function reportpro() {
            $repPro = mysqli_query($this->dbcon, "SELECT * FROM report_pro LEFT JOIN users ON report_pro.user_id=users.user_id LEFT JOIN products ON report_pro.pro_id=products.pro_id ");
            return $repPro;
        }
        public function report_pro($id) {
            $report_pro = mysqli_query($this->dbcon, "SELECT * FROM report_pro LEFT JOIN users ON report_pro.user_id=users.user_id LEFT JOIN products ON report_pro.pro_id=products.pro_id WHERE report_pro.id='$id'");
            return $report_pro;
        }
        public function reportshop() {
            $repShop = mysqli_query($this->dbcon, "SELECT * FROM report_shop LEFT JOIN users ON report_shop.user_id=users.user_id LEFT JOIN shop ON report_shop.shop_id=shop.shop_id");
            return $repShop;
        }
        public function reportproRead() {
            $repProR = mysqli_query($this->dbcon, "SELECT * FROM report_pro LEFT JOIN users ON report_pro.user_id=users.user_id LEFT JOIN products ON report_pro.pro_id=products.pro_id WHERE report_status=1");
            return $repProR;
        }
        public function reportshopRead() {
            $repShopR = mysqli_query($this->dbcon, "SELECT * FROM report_shop LEFT JOIN users ON report_shop.user_id=users.user_id LEFT JOIN shop ON report_shop.shop_id=shop.shop_id WHERE report_status=1");
            return $repShopR;
        }
        public function reportproNoRead() {
            $repProN = mysqli_query($this->dbcon, "SELECT * FROM report_pro LEFT JOIN users ON report_pro.user_id=users.user_id LEFT JOIN products ON report_pro.pro_id=products.pro_id WHERE report_status=0");
            return $repProN;
        }
        public function reportshopNoRead() {
            $repShopN = mysqli_query($this->dbcon, "SELECT * FROM report_shop LEFT JOIN users ON report_shop.user_id=users.user_id LEFT JOIN shop ON report_shop.shop_id=shop.shop_id WHERE report_status=0");
            return $repShopN;
        }
        public function reportdetailshop() {
            $repShopN = mysqli_query($this->dbcon, "SELECT * FROM report_shop LEFT JOIN users ON report_shop.user_id=users.user_id LEFT JOIN shop ON report_shop.shop_id=shop.shop_id WHERE report_status=0");
            return $repShopN;
        }
        public function reportshopdetail($id) {
            $repShopN = mysqli_query($this->dbcon, "SELECT * FROM report_shop LEFT JOIN users ON report_shop.user_id=users.user_id LEFT JOIN shop ON report_shop.shop_id=shop.shop_id WHERE report_status=0 AND id = '$id'");
            return $repShopN;
        }

        // --------------------------------------------------------------------------------------------------------------------------------------

        #เพิ่มสมาชิก
        public function registrationWorld($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$user_district,$user_provinces,$user_postID,$fileName) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO users(user_email,user_password,user_fullname,user_tel,user_address,user_road,user_soi,user_subdistrict,user_district,user_provinces,user_postID,user_img,user_role,user_regDate) VALUES ('$user_email','$user_password','$user_fullname','$user_tel','$user_address','$user_road','$user_soi','$user_subdistrict','$user_district','$user_provinces','$user_postID','$fileName','3',NOW())");
            return $reg;
        }
        public function registrationLocal($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$user_district,$user_provinces,$user_postID,$fileName) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO users(user_email,user_password,user_fullname,user_tel,user_address,user_road,user_soi,user_subdistrict,user_district,user_provinces,user_postID,user_img,user_role,user_regDate) VALUES ('$user_email','$user_password','$user_fullname','$user_tel','$user_address','$user_road','$user_soi','$user_subdistrict','$user_district','$user_provinces','$user_postID','$fileName','4',NOW())");
            return $reg;
        }
        public function addmember($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$user_role,$fileName) {
            $addmem = mysqli_query($this->dbcon, "INSERT INTO users(user_email,user_password,user_fullname,user_tel,user_address,user_road,user_soi,user_subdistrict,user_img,user_role,user_regDate) VALUES ('$user_email','$user_password','$user_fullname','$user_tel','$user_address','$user_road','$user_soi','$user_subdistrict','$fileName','$user_role',NOW())");
            return $addmem;
        }
        public function addcatagory($cat_name) {
            $addcatagory = mysqli_query($this->dbcon, "INSERT INTO catagory(cat_name) VALUES ('$cat_name')");
            return $addcatagory;
        }
        public function insertaddress($user_id,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$province_id,$district_id,$subdistrict_id,$user_province,$user_district,$user_subdistrict,$user_zipcode) {
            $insertaddress = mysqli_query($this->dbcon, "INSERT INTO user_address (user_id, user_fullname, user_tel, user_address, user_road, user_soi, province_id, district_id, subdistrict_id,user_province, user_district, user_subdistrict, user_zipcode, address_role) VALUES ('$user_id', '$user_fullname', '$user_tel', '$user_address', '$user_road', '$user_soi', '$province_id', '$district_id', '$subdistrict_id', '$user_province', '$user_district', '$user_subdistrict', '$user_zipcode', 'บ้าน')");
            return $insertaddress;
        }


        // ----------------------------------------------------------------------------------------------------------------------------------------

        #อัปเดต
        public function update_request($user_id,$status) {
            $update_request = mysqli_query($this->dbcon, "UPDATE users SET user_role = '$status' WHERE users.user_id='$user_id'");
            return $update_request;
        }
        public function update_user_status($st_full,$user_id) {
            $update_user_status = mysqli_query($this->dbcon, "UPDATE users SET user_status = '$st_full' WHERE users.user_id='$user_id'");
            return $update_user_status;
        }
        public function update_pro_status($st_full,$pro_id) {
            $update_pro_status = mysqli_query($this->dbcon, "UPDATE products SET pro_ban = '$st_full' WHERE products.pro_id='$pro_id'");
            return $update_pro_status;
        }
        public function update_shop_status($st_full,$shop_id) {
            $update_shop_status = mysqli_query($this->dbcon, "UPDATE shop SET shop_status = '$st_full' WHERE shop.shop_id='$shop_id'");
            return $update_shop_status;
        }
        public function update_product($pro_id, $cat_id, $pro_name, $pro_price, $pro_amount, $pro_detail, $pro_send, $fileName) {
            $update_product = mysqli_query($this->dbcon, "UPDATE products SET cat_id = '$cat_id',pro_name = '$pro_name',pro_price = '$pro_price',pro_amount = '$pro_amount',pro_detail = '$pro_detail',update_date = NOW(),pro_send = '$pro_send',pro_img = '$fileName' WHERE pro_id='$pro_id'");
            return $update_product;
        }
        public function update_shop($shop_id,$shop_name,$shop_detail,$fileName) {
            $update_shop = mysqli_query($this->dbcon, "UPDATE shop SET shop_name = '$shop_name',shop_detail = '$shop_detail',shop_img = '$fileName' WHERE shop_id='$shop_id'");
            return $update_shop;
        }
        public function update_user($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$user_role,$fileName,$user_id) {
            $update_user = mysqli_query($this->dbcon, "UPDATE users SET user_email = '$user_email',user_password = '$user_password',user_fullname = '$user_fullname',user_tel = '$user_tel',user_address = '$user_address',user_road = '$user_road',user_soi = '$user_soi',user_subdistrict = '$user_subdistrict',user_img = '$fileName',user_role = '$user_role' WHERE user_id='$user_id' ");
            return $update_user;
        }
        public function update_user_address($user_fullname,$user_tel,$user_address,$user_road,$user_soi,$province_id,$district_id,$subdistrict_id,$user_province,$user_district,$user_subdistrict,$user_zipcode,$user_id) {
            $update_user_address = mysqli_query($this->dbcon, "UPDATE user_address SET user_fullname='$user_fullname',user_tel='$user_tel',user_address='$user_address',user_road='$user_road',user_soi='$user_soi',province_id='$province_id',district_id='$district_id',subdistrict_id='$subdistrict_id',user_province='$user_province',user_district='$user_district',user_subdistrict='$user_subdistrict',user_zipcode='$user_zipcode' WHERE user_id='$user_id' AND address_role='บ้าน' ");
            return $update_user_address;
        }
        public function update_cat($cat_id,$cat_name) {
            $update_cat = mysqli_query($this->dbcon, "UPDATE catagory SET cat_name = '$cat_name' WHERE catagory.id='$cat_id'");
            return $update_cat;
        }

        // ------------------------------------------------------------------------------------------------------------------------------------

        #การลบ

        public function delete_user($user_id) {
            $delete_user = mysqli_query($this->dbcon, "DELETE FROM users WHERE user_id='$user_id'");
            $delete_cart = mysqli_query($this->dbcon, "DELETE FROM cart WHERE user_id='$user_id'");
            $delete_comment = mysqli_query($this->dbcon, "DELETE FROM comment WHERE user_id='$user_id'");
            $delete_com_reply = mysqli_query($this->dbcon, "DELETE FROM com_reply WHERE user_id='$user_id'");
            $delete_detect_conversation = mysqli_query($this->dbcon, "DELETE FROM detect_conversation WHERE user_id='$user_id'");
            $delete_orders = mysqli_query($this->dbcon, "DELETE FROM orders WHERE user_id='$user_id'");
            $delete_report_pro = mysqli_query($this->dbcon, "DELETE FROM report_pro  WHERE user_id='$user_id'");
            $delete_report_shop = mysqli_query($this->dbcon, "DELETE FROM report_shop  WHERE user_id='$user_id'");
            $delete_shop = mysqli_query($this->dbcon, "DELETE FROM shop WHERE user_id='$user_id'");
            return $delete_user;
            return $delete_cart;
            return $delete_comment;
            return $delete_com_reply;
            return $delete_detect_conversation;
            return $delete_orders;
            return $delete_report_pro;
            return $delete_report_shop;
            return $delete_shop;
        }
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
        public function delete_catagory($cat_id) {
            $delete_catagory = mysqli_query($this->dbcon, "DELETE FROM catagory WHERE id='$cat_id'");
            return $delete_catagory;
        }

        // ----------------------------------------------------------------------------------------------------------------------------------------

        #เรียกสินค้า
        public function allproduct() {
            $allpro = mysqli_query($this->dbcon, "SELECT * FROM products ");
            return $allpro;
        }
        public function products($pro_id) {
            $pro = mysqli_query($this->dbcon, "SELECT * FROM products LEFT JOIN shop ON products.shop_id=shop.shop_id LEFT JOIN catagory ON products.cat_id=catagory.id WHERE pro_id='$pro_id' ");
            return $pro;
        }
        public function shop_products($shop_id) {
            $shop_pro = mysqli_query($this->dbcon, "SELECT * FROM products WHERE shop_id='$shop_id' ");
            return $shop_pro;
        }
        public function cat_products($cat_id) {
            $cat_products = mysqli_query($this->dbcon, "SELECT * FROM products WHERE cat_id='$cat_id' ");
            return $cat_products;
        }

        // ----------------------------------------------------------------------------------------------------------------------------------------

        #เรียกหมวดหมู่
        public function catagory() {
            $cat = mysqli_query($this->dbcon, "SELECT * FROM catagory");
            return $cat;
        }
        public function whatcatagory($id) {
            $whatcatagory = mysqli_query($this->dbcon, "SELECT * FROM catagory WHERE id='$id';");
            return $whatcatagory;
        }

        // ----------------------------------------------------------------------------------------------------------------------------------------

        #เรียกสมาชิก
        public function allmember() {
            $allmem = mysqli_query($this->dbcon, "SELECT * FROM users ");
            return $allmem;
        }
        public function member($user_id) {
            $mem = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_id='$user_id' ");
            return $mem;
        }
        public function adminmember() {
            $adminmem = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_role=1");
            return $adminmem;
        }
        public function groupmember() {
            $groupmem = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_role=2");
            return $groupmem;
        }
        public function genmember() {
            $genmem = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_role=3");
            return $genmem;
        }
        public function requestmember() {
            $reqmem = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_role=4");
            return $reqmem;
        }
        public function requestdetail($user_id) {
            $reqde = mysqli_query($this->dbcon, "SELECT * FROM users WHERE user_id='$user_id'");
            return $reqde;
        }
        public function searchid($email) {
            $checkuser = mysqli_query($this->dbcon, "SELECT * FROM users WHERE users.user_email = '$email'");
            return $checkuser;
        }

        // ----------------------------------------------------------------------------------------------------------------------------------------

        #เรียกร้านค้า
        public function shop($shop_id) {
            $shop = mysqli_query($this->dbcon, "SELECT * FROM shop LEFT JOIN users ON shop.user_id=users.user_id WHERE shop_id='$shop_id' ");
            return $shop;
        }
        public function whoshop($user_id) {
            $whoshop = mysqli_query($this->dbcon, "SELECT * FROM shop WHERE user_id='$user_id' ");
            return $whoshop;
        }
        public function allshop() {
            $allshop = mysqli_query($this->dbcon, "SELECT * FROM shop LEFT JOIN users ON shop.user_id=users.user_id ");
            return $allshop;
        }

        #-------------------------------------------------------------------------------------------------------------

        #counting
        public function countrequest() {
            $countrequest = mysqli_query($this->dbcon, "SELECT COUNT(user_id) AS countrequest FROM users WHERE users.user_status = '4';");
            return $countrequest;
        }
        public function countuser() {
            $countuser = mysqli_query($this->dbcon, "SELECT COUNT(user_id) AS countuser FROM users WHERE users.user_status != '4';");
            return $countuser;
        }
        public function countshop() {
            $countshop = mysqli_query($this->dbcon, "SELECT COUNT(shop_id) AS countshop FROM shop ;");
            return $countshop;
        }
        public function countproduct() {
            $countproduct = mysqli_query($this->dbcon, "SELECT COUNT(pro_id) AS countproduct FROM products ;");
            return $countproduct;
        }
        public function count_cat_product($cat_id) {
            $count_cat_product = mysqli_query($this->dbcon, "SELECT COUNT(pro_id) AS count_cat_product FROM products WHERE cat_id='$cat_id';");
            return $count_cat_product;
        }
        public function countreportshop() {
            $countreportshop = mysqli_query($this->dbcon, "SELECT COUNT(id) AS countreportshop FROM report_shop ;");
            return $countreportshop;
        }
        public function countreportproduct() {
            $countreportproduct = mysqli_query($this->dbcon, "SELECT COUNT(id) AS countreportproduct FROM report_pro ;");
            return $countreportproduct;
        }
        public function countshoptotal($shop_id) {
            $countshoptotal = mysqli_query($this->dbcon, "SELECT COUNT(id) AS count_total_shop FROM orders WHERE shop_id='$shop_id';");
            return $countshoptotal;
        }

        #-----------------------------------------------------------------------------------------------------------------------
        #การเงิน
        public function thisweekp() {
            $thisweekp = mysqli_query($this->dbcon, "SELECT days_of_week.day_name, COALESCE(SUM(orders.total_price), 0) AS total_price FROM ( SELECT 'Sunday' AS day_name UNION SELECT 'Monday' UNION SELECT 'Tuesday' UNION SELECT 'Wednesday' UNION SELECT 'Thursday' UNION SELECT 'Friday' UNION SELECT 'Saturday') AS days_of_week LEFT JOIN orders ON days_of_week.day_name = DATE_FORMAT(orders.ord_date, '%W') WHERE WEEK(orders.ord_date) = WEEK(NOW()) OR orders.ord_date IS NULL GROUP BY days_of_week.day_name;");
            return $thisweekp;
        }
        public function lastweekp($shop_id) {
            $lastweekp = mysqli_query($this->dbcon, "SELECT DATE_FORMAT(add_date, '%W') AS day_of_week, SUM(pro_price) AS total_price FROM products WHERE WEEK(add_date) = WEEK(DATE_SUB(NOW(), INTERVAL 1 WEEK)) GROUP BY DAYOFWEEK(add_date);");
            return $lastweekp;
        }
        public function yeartotal() {
            $yeartotal = mysqli_query($this->dbcon, "SELECT SUM(CASE WHEN WEEK(ord_date) = WEEK(CURRENT_DATE()) THEN total_price ELSE 0 END) AS total_week, SUM(CASE WHEN YEAR(ord_date) = YEAR(CURRENT_DATE()) THEN total_price ELSE 0 END) AS total_year FROM orders;");
            return $yeartotal;
        }
        public function weektotal($shop_id) {
            $weektotal = mysqli_query($this->dbcon, "SELECT SUM(total_price) AS total_week FROM orders WHERE WEEK(ord_date) = WEEK(CURRENT_TIMESTAMP);");
            return $weektotal;
        }
        public function shoptotal($shop_id) {
            $shoptotal = mysqli_query($this->dbcon, "SELECT SUM(total_price) AS total_shop FROM orders WHERE shop_id='$shop_id';");
            return $shoptotal;
        }

        #The best

        
        public function bestshop() {
            $bestshop = mysqli_query($this->dbcon, "SELECT @row_number := @row_number + 1 AS `No.`, shop_id, shop_name, total_price_sum FROM ( SELECT orders.shop_id AS shop_id,shop_name, SUM(total_price) AS total_price_sum FROM orders INNER JOIN shop ON orders.shop_id=shop.shop_id GROUP BY orders.shop_id ORDER BY total_price_sum DESC ) AS ranked, (SELECT @row_number := 0) AS x;");
            return $bestshop;
        }
        public function bestproducts() {
            $bestproducts = mysqli_query($this->dbcon, "SELECT @row_number := @row_number + 1 AS `No.`, pro_id, pro_name, pro_selled, total_price_sum FROM ( SELECT orders.pro_id AS pro_id,pro_name,pro_selled, SUM(total_price) AS total_price_sum FROM orders INNER JOIN products ON orders.pro_id=products.pro_id GROUP BY orders.pro_id ORDER BY total_price_sum DESC ) AS ranked, (SELECT @row_number := 0) AS x;");
            return $bestproducts;
        }
    }
?>
