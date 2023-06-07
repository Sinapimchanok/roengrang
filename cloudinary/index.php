<?php
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dlne5j5ub', 
    'api_key' => '232327965775433', 
    'api_secret' => 'jJbI7p20xpDJzI4tPNNf9w8R_zg'],
  'url' => [
    'secure' => true]]);

//$result = (new UploadApi())->upload('unnamed.jpg');#เพิ่มรูป
//$imageName = $result['public_id'];#ชื่อรูป

//$imageUrl = 'https://res.cloudinary.com/dctzkxkyd/image/upload/' . $imageName;

// $imageUrl = 'https://res.cloudinary.com/dctzkxkyd/image/upload/cld-sample-5';
// Display the uploaded image

// echo '<img src="' . $imageUrl . '">';
//echo '<br>'. $imageName ;
?>
