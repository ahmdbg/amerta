<?php
require_once 'vendor/autoload.php';
include 'config/db.php';

header('Content-Type: application/json');

$term = $_GET['term'] ?? '';
$term = trim($term);

if ($term === '') {
    echo json_encode([]);
    exit;
}

// Prepare term for LIKE query
$like_term = $term . '%';

// Query donatur names
$donatur_sql = "SELECT nama_donatur AS name FROM donatur WHERE nama_donatur LIKE ?";

$donatur_stmt = mysqli_prepare($conn, $donatur_sql);
mysqli_stmt_bind_param($donatur_stmt, "s", $like_term);
mysqli_stmt_execute($donatur_stmt);
$donatur_result = mysqli_stmt_get_result($donatur_stmt);

$donaturs = [];
while ($row = mysqli_fetch_assoc($donatur_result)) {
    $donaturs[] = $row['name'];
}
mysqli_stmt_close($donatur_stmt);

// Return JSON array
echo json_encode(array_values($donaturs));
exit;
?>
