<?php
include './config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    $sql = "UPDATE pengunjung SET status_pakai = 'sudah_dipakai' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $success = mysqli_stmt_execute($stmt);
    
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['success' => false]);
}