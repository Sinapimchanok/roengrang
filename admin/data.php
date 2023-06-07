<?php
	header('Content-Type: application/json');

	$conn = mysqli_connect("localhost","root","","roengrang");

	$sqlQuery = "SELECT days_of_week.day_name, COALESCE(SUM(orders.total_price), 0) AS total_price FROM ( SELECT 'Sunday' AS day_name UNION SELECT 'Monday' UNION SELECT 'Tuesday' UNION SELECT 'Wednesday' UNION SELECT 'Thursday' UNION SELECT 'Friday' UNION SELECT 'Saturday') AS days_of_week LEFT JOIN orders ON days_of_week.day_name = DATE_FORMAT(orders.ord_date, '%W') WHERE WEEK(orders.ord_date) = WEEK(NOW()) OR orders.ord_date IS NULL GROUP BY days_of_week.day_name;";

	$result = mysqli_query($conn,$sqlQuery);

	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}

	mysqli_close($conn);

	echo json_encode($data);
?>