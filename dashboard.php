<?php
require_once './config/db.php';


// Fetch data from pengunjung table
$query = "SELECT * FROM pengunjung";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengunjung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #212529 !important;
            color: #fff !important;
        }

        .card {
            background-color: #2c3034 !important;
            border-color: #373b3e !important;
        }

        .table {
            color: #fff !important;
            background-color: #2c3034 !important;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #343a40 !important;
            border-bottom: 2px solid #454d55 !important;
            font-weight: 600;
            padding: 12px !important;
        }

        .table tbody td {
            padding: 12px !important;
            vertical-align: middle;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        .table-striped tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.075) !important;
            transition: all 0.2s ease;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background-color: #343a40 !important;
            border: 1px solid #454d55 !important;
            color: #fff !important;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #343a40 !important;
            border: 1px solid #454d55 !important;
            border-radius: 4px;
            margin: 0 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #454d55 !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #666 !important;
        }

        .table-bordered td,
        .table-bordered th {
            border-color: #373b3e !important;
        }
    </style>
</head>

<body class="bg-dark text-light">
    <div class="container mt-5">
        <h2>Data Pengunjung</h2>
        <div class="mb-3">
            <a href="export_excel.php" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export to Excel
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="visitorTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Keperluan</th>
                            <th>Keperluan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jk']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_murid']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['no_wa']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nomor_kursi']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#visitorTable').DataTable();
        });
    </script>
</body>

</html>