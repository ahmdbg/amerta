<?php
require_once './config/db.php';

header('Content-Type: application/json');

$query = "SELECT * FROM pengunjung";
$result = mysqli_query($conn, $query);

$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

echo json_encode($rows);
?>
