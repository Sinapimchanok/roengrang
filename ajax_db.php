<?php
  include_once('functions.php'); 
    
  $sql = new DB_con();


  if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
  	$id = $_POST['id'];
    $query = $sql->district($id);
  	echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ/เขต-</option>';
  	foreach ($query as $value) {
  		echo '<option value="'.$value['code'].'">'.$value['name_th'].'</option>';
  		
  	}
  }


if (isset($_POST['function']) && $_POST['function'] == 'district') {
    $id = $_POST['id'];
    $query = $sql->subdistrict($id);
    echo '<option value="" selected disabled>-กรุณาเลือกตำบล/แขวง-</option>';
    foreach ($query as $value2) {
      echo '<option value="'.$value2['code'].'">'.$value2['name_th'].'</option>';
      
    }
  }

  if (isset($_POST['function']) && $_POST['function'] == 'subdistrict') {
    $id = $_POST['id'];
    $query3 = $sql->zip_code($id);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
  }
?>