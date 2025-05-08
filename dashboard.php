<?php
require_once './config/db.php';
$query = "SELECT * FROM pengunjung";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengunjung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwind.min.css">
</head>

<body class="bg-slate-900 min-h-screen">
    <nav class="bg-slate-800 shadow-lg py-4 px-6 mb-8">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-white">Sistem Pengunjung</h1>
        </div>
    </nav>

    <main class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4 md:mb-0">Data Pengunjung</h2>
            <div class="flex space-x-4">
                <a href="export_excel.php"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" />
                    </svg>
                    Export to Excel
                </a>
            </div>
        </div>

        <div class="bg-slate-800 rounded-xl shadow-2xl overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table id="visitorTable" class="w-full text-white">
                        <thead class="bg-slate-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">No</th>
                                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                                <th class="px-6 py-4 text-left font-semibold">Jk</th>
                                <th class="px-6 py-4 text-left font-semibold">Kelas</th>
                                <th class="px-6 py-4 text-left font-semibold">Nama santri</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">no_WA</th>
                                <th class="px-6 py-4 text-left font-semibold">Nomor Kursi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class='hover:bg-slate-700 transition-colors'>";
                                echo "<td class='px-6 py-4'>" . $no++ . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['jk']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['kelas']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['nama_murid']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['no_wa']) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($row['nomor_kursi']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#visitorTable').DataTable({
                responsive: true,
                dom: '<"flex flex-col lg:flex-row justify-between items-center mb-6"lf>rtip',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                initComplete: function() {
                    $('.dataTables_length select').addClass('bg-slate-700 text-white border-slate-600 rounded-lg px-3 py-2');
                    $('.dataTables_filter input').addClass('bg-slate-700 text-white border border-slate-600 rounded-lg px-4 py-2 ml-2 focus:outline-none focus:ring-2 focus:ring-blue-500');
                    $('.dataTables_info').addClass('text-white mt-4');
                    $('.dataTables_paginate').addClass('text-white mt-4');
                    $('.paginate_button').addClass('px-4 py-2 mx-1 rounded-lg hover:bg-slate-700');
                    $('.paginate_button.current').addClass('bg-blue-600');
                }
            });
        });
    </script>
</body>

</html>