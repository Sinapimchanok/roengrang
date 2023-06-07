<?php
    session_start();
    $shop_is=$_SESSION['shop_id'];
	header('Content-Type: application/json');

	$conn = mysqli_connect("localhost","root","","roengrang");

	$sqlQuery = "SELECT day_of_week.day_number, COALESCE(SUM(orders.total_price), 0) AS total_price FROM (SELECT 1 AS day_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7) AS day_of_week LEFT JOIN orders ON DAYOFWEEK(orders.ord_date) = day_of_week.day_number AND WEEK(orders.ord_date) = WEEK(NOW()) AND shop_id='$shop_is' GROUP BY day_of_week.day_number;";

	$result = mysqli_query($conn,$sqlQuery);

	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}

	mysqli_close($conn);

	echo json_encode($data);
?>