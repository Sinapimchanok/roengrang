<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "roengrang");

$sqlQuery = "SELECT months_of_year.month_number, COALESCE(SUM(total_price), 0) AS total_price FROM (SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months_of_year LEFT JOIN orders ON months_of_year.month_number = MONTH(orders.ord_date) WHERE YEAR(orders.ord_date) = YEAR(NOW()) OR orders.ord_date IS NULL GROUP BY months_of_year.month_number;";

$result = mysqli_query($conn, $sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
