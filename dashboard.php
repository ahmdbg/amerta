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
            background-color: #001f3f !important;
            color: #fff !important;
        }

        .card {
            background-color: #002c59 !important;
            border-color: #003d7a !important;
        }

        .table {
            color: #fff !important;
            background-color: #002c59 !important;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #001f3f !important;
            border-bottom: 2px solid #003d7a !important;
            font-weight: 600;
            padding: 12px !important;
        }

        .table tbody td {
            padding: 12px !important;
            vertical-align: middle;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #00264d !important;
        }

        .table-striped tbody tr:hover {
            background-color: #003366 !important;
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
            background-color: #001f3f !important;
            border: 1px solid #003d7a !important;
            color: #fff !important;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #001f3f !important;
            border: 1px solid #003d7a !important;
            border-radius: 4px;
            margin: 0 4px;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #003366 !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #004080 !important;
            border-color: #004080 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #8ba3bc !important;
        }

        .table-bordered td,
        .table-bordered th {
            border-color: #003d7a !important;
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
                            <th>Jk</th>
                            <th>Kelas</th>
                            <th>Nama santri</th>
                            <th>Tanggal</th>
                            <th>no_WA</th>
                            <th>Nomor Kursi</th>
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