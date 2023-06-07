<?php 

    include_once('cloudinary/index.php'); 
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

        public function usernameavailable($email) {
            $checkuser = mysqli_query($this->dbcon, "SELECT email FROM users WHERE email = '$email'");
            return $checkuser;
        }

        public function registrationWorld($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$fileName) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO users(user_email,user_password,user_fullname,user_tel,user_address,user_road,user_soi,user_subdistrict,user_img,user_role,user_regDate) VALUES ('$user_email','$user_password','$user_fullname','$user_tel','$user_address','$user_road','$user_soi','$user_subdistrict','$fileName','3',NOW())");
            return $reg;
        }

        public function registrationLocal($user_email,$user_password,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_subdistrict,$fileName) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO users(user_email,user_password,user_fullname,user_tel,user_address,user_road,user_soi,user_subdistrict,user_img,user_role,user_regDate) VALUES ('$user_email','$user_password','$user_fullname','$user_tel','$user_address','$user_road','$user_soi','$user_subdistrict','$fileName','4',NOW())");
            return $reg;
        }

        public function insertaddress($user_id,$user_fullname,$user_tel,$user_address,$user_road,$user_soi,$user_province,$user_district,$user_subdistrict,$user_zipcode) {
            $insertaddress = mysqli_query($this->dbcon, "INSERT INTO user_address (user_id, user_fullname, user_tel, user_address, user_road, user_soi, user_province, user_district, user_subdistrict, user_zipcode, address_role) VALUES ('$user_id', '$user_fullname', '$user_tel', '$user_address', '$user_road', '$user_soi', '$user_province', '$user_district', '$user_subdistrict', '$user_zipcode', 'บ้าน')");
            return $insertaddress;
        }

        public function searchid($email) {
            $checkuser = mysqli_query($this->dbcon, "SELECT * FROM users WHERE users.user_email = '$email'");
            return $checkuser;
        }

        public function address($sub_id) {
            $address = mysqli_query($this->dbcon, "SELECT subdistrict.name_th as subdistrict_name,district.name_th  as district_name,provinces.name_th  as provinces_name,zip_code FROM subdistrict  LEFT JOIN district ON subdistrict.district_code=district.code LEFT JOIN provinces ON district.province_code=provinces.code WHERE subdistrict.code='$sub_id'");
            return $address;
        }

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

        public function signin($email, $password) {
            $signinquery = mysqli_query($this->dbcon, "SELECT user_id, user_fullname ,user_role FROM users WHERE user_email = '$email' AND user_password = '$password'");
            return $signinquery;
        }
    }
?>