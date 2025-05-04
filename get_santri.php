<?php
include './config/db.php';

header('Content-Type: application/json');

if (isset($_GET['kelas'])) {
    $kelas = mysqli_real_escape_string($conn, $_GET['kelas']);
    
    // Modified query to check jumlah_terpilih
    $sql = "SELECT m.nama 
            FROM murid m 
            LEFT JOIN (
                SELECT nama_murid, COUNT(*) as jumlah_terpilih 
                FROM pengunjung 
                GROUP BY nama_murid
            ) p ON m.nama = p.nama_murid 
            WHERE m.kelas = ? 
            AND (p.jumlah_terpilih IS NULL OR p.jumlah_terpilih < 2)
            ORDER BY m.nama ASC";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $kelas);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $santri = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $santri[] = $row;
    }
    
    echo json_encode($santri);
    
    mysqli_stmt_close($stmt);
} else {
    echo json_encode([]);
}

mysqli_close($conn);