<?php
// Assuming you have a database connection established

// Get the product ID from the AJAX request
$product_id = $_POST['product_id'];

if ($product_id) {
    echo "success";
} else {
    echo "error";
}
?>
