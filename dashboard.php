<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Pengunjung</title>
    <link rel="icon" type="image/png" href="./img/icon/icon.png">
    <meta name="description"
        content="Amerta Night Show adalah ajang ekspresi dan kreativitas bagi para santri untuk menampilkan karya terbaik mereka di atas panggung.">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwind.min.css" />
    <style>
        body {
            font-family: 'Mulish', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 font-mulish min-h-screen">
    <nav class="bg-slate-900 shadow-lg py-4 px-6 mb-8">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <img class="h-9 w-auto mr-2" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo">
                <span class="text-slate-100 text-lg font-bold leading-4">AMERTA<br>NIGHT SHOW</span>
            </div>
            <a href="index.html#ticket-section" class="bg-gradient-to-r from-blue-700 via-blue-500 to-sky-700 text-white font-bold px-5 py-2 rounded-lg shadow-md transition duration-200 hover:shadow-lg hover:from-blue-800 hover:to-sky-800">GET TICKET</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-3xl font-bold text-blue-300 mb-4 md:mb-0 tracking-wide">Data Pengunjung</h2>
            <div class="flex space-x-4">
                <a href="export_excel.php?jk=laki-laki"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" />
                    </svg>
                    Export Laki-laki to Excel
                </a>
                <a href="export_excel.php?jk=perempuan"
                    class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" />
                    </svg>
                    Export Perempuan to Excel
                </a>
            </div>
        </div>

        <div class="bg-slate-900 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table id="visitorTable" class="w-full text-white">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">No</th>
                                <th class="px-6 py-4 text-left font-semibold">Nama</th>
                                <th class="px-6 py-4 text-left font-semibold">Jk</th>
                                <th class="px-6 py-4 text-left font-semibold">Kelas</th>
                                <th class="px-6 py-4 text-left font-semibold">Nama santri</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">no_WA</th>
                                <th class="px-6 py-4 text-left font-semibold">Nomor Kursi</th>
                                <th class="px-6 py-4 text-left font-semibold">Akses Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#visitorTable').DataTable({
                responsive: true,
                paging: false,
                lengthChange: false,
                dom: '<"flex flex-col lg:flex-row justify-between items-center mb-6"f>rtip',
                language: {
                    search: "Cari:",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
                },
                initComplete: function() {
                    $('.dataTables_filter input').addClass('bg-slate-800 text-white border border-slate-700 rounded-lg px-4 py-2 ml-2 focus:outline-none focus:ring-2 focus:ring-blue-500');
                    $('.dataTables_info').addClass('text-white mt-4');
                }
            });

            var previousDataLength = 0;

            // Add CSS for transition effect
            $('<style>')
                .prop('type', 'text/css')
                .html('\n\
                .row-transition {\n\
                    transition: background-color 1s ease, opacity 1s ease;\n\
                    background-color: #16a34a; /* Tailwind green-600 */\n\
                    opacity: 0;\n\
                }\n\
                .row-transition.show {\n\
                    opacity: 1;\n\
                    background-color: transparent;\n\
                }\n\
                ')
                .appendTo('head');

            function animateNewRows(newRowIndexes) {
                newRowIndexes.forEach(function(index) {
                    var rowNode = $(table.row(index).node());
                    rowNode.addClass('row-transition');
                    // Trigger reflow to restart the transition
                    void rowNode[0].offsetWidth;
                    rowNode.addClass('show');
                    // Remove the classes after transition duration
                    setTimeout(function() {
                        rowNode.removeClass('row-transition show');
                    }, 1000);
                });
            }

            function fetchData() {
                $.ajax({
                    url: 'fetch_pengunjung.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var newRowIndexes = [];
                        table.clear();
                        var no = 1;
                        data.forEach(function(row, idx) {
                            table.row.add([
                                no++,
                                row.nama,
                                row.jk,
                                row.kelas,
                                row.nama_murid,
                                row.status,
                                row.no_wa,
                                row.nomor_kursi,
                                '<a href="konfirmasi.php?id=' + row.id + '" class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors" target="_blank">Lihat Konfirmasi</a>'
                            ]);
                            if (idx >= previousDataLength) {
                                newRowIndexes.push(idx);
                            }
                        });
                        table.draw(false);
                        if (newRowIndexes.length > 0) {
                            animateNewRows(newRowIndexes);
                        }
                        previousDataLength = data.length;
                    },
                    error: function() {
                        console.error('Failed to fetch data');
                    }
                });
            }

            fetchData();
            setInterval(fetchData, 5000); // Refresh every 5 seconds
        });
    </script>
</body>

</html>