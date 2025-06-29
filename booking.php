<?php
require_once 'vendor/autoload.php';
include 'config/db.php';

// Check total visitors count
$visitor_limit = 100;
$visitor_count = 0;
$count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengunjung");
if ($count_result) {
    $row = mysqli_fetch_assoc($count_result);
    $visitor_count = (int)$row['total'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        mysqli_begin_transaction($conn);

        // Get and sanitize form data using array_map
        $data = array_map('htmlspecialchars', [
            'nama_wali' => $_POST['nama_wali'] ?? '',
            'jenis_kelamin' => $_POST['jenis_kelamin'] ?? '',
            'kelas_murid' => $_POST['kelas_murid'] ?? '',
            'nama_murid' => $_POST['nama_murid'] ?? '',
            'status_menginap' => $_POST['status_menginap'] ?? '',
            'no_wa' => $_POST['no_wa'] ?? ''
        ]);

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new Exception("Field $key is required");
            }
        }

        // Real-time visitor count check before proceeding
        $count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengunjung");
        if ($count_result) {
            $row = mysqli_fetch_assoc($count_result);
            $current_visitor_count = (int)$row['total'];
            if ($current_visitor_count >= $visitor_limit) {
                throw new Exception("Maaf, kuota pengunjung sudah mencapai batas maksimal. Pendaftaran ditutup.");
            }
        } else {
            throw new Exception("Gagal memeriksa kuota pengunjung.");
        }

        // Determine seat range based on gender
        $gender_range = ($data['jenis_kelamin'] === 'L') ? [11, 120] : [121, 211];

        // Find available seat using a single query
        $sql_seat = "SELECT MIN(a.seat) as available_seat
                     FROM (
                         SELECT @row := @row + 1 as seat
                         FROM (SELECT @row := ?) r,
                              information_schema.columns
                         LIMIT ?) a
                     LEFT JOIN pengunjung p ON a.seat = p.nomor_kursi
                     WHERE p.nomor_kursi IS NULL
                     AND a.seat <= ?";

        $start = $gender_range[0] - 1;
        $limit = $gender_range[1] - $gender_range[0] + 1;

        $stmt = mysqli_prepare($conn, $sql_seat);
        mysqli_stmt_bind_param($stmt, "iii", $start, $limit, $gender_range[1]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $seat_data = mysqli_fetch_assoc($result);

        if (!$seat_data['available_seat']) {
            throw new Exception("Maaf, kursi untuk kategori ini sudah penuh.");
        }

        $seat_number = $seat_data['available_seat'];

        // Prepare batch insert
        $sql = "INSERT INTO pengunjung (nama, jk, kelas, nama_murid, status, no_wa, nomor_kursi) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssi",
            $data['nama_wali'],
            $data['jenis_kelamin'],
            $data['kelas_murid'],
            $data['nama_murid'],
            $data['status_menginap'],
            $data['no_wa'],
            $seat_number
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to insert booking data");
        }

        $inserted_id = mysqli_insert_id($conn);

        // Update jumlah_terpilih efficiently
        $update_sql = "UPDATE murid 
                      SET jumlah_terpilih = COALESCE(jumlah_terpilih, 0) + 1 
                      WHERE nama = ? 
                      AND (SELECT COUNT(*) FROM pengunjung WHERE nama_murid = ?) < 3";

        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "ss", $data['nama_murid'], $data['nama_murid']);

        if (!mysqli_stmt_execute($update_stmt)) {
            throw new Exception("Failed to update murid count");
        }

        if (mysqli_affected_rows($conn) === 0) {
            throw new Exception("Santri sudah mencapai batas maksimal pemesanan");
        }

        // Commit transaction
        mysqli_commit($conn);

        // Send WhatsApp message asynchronously
        include 'send_whatsapp.php';
        sendWhatsAppMessage($data, $seat_number);

        header("Location: konfirmasi.php?id=" . $inserted_id);
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('" . htmlspecialchars($e->getMessage()) . "'); window.location.href='booking.php';</script>";
        exit;
    } finally {
        if (isset($stmt)) mysqli_stmt_close($stmt);
        if (isset($update_stmt)) mysqli_stmt_close($update_stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amerta | Booking</title>
    <link rel="icon" type="image/png" href="./img/icon/icon.png">
    <meta name="description"
        content="Amerta Night Show adalah ajang ekspresi dan kreativitas bagi para santri untuk menampilkan karya terbaik mereka di atas panggung.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style type="text/tailwindcss">
        @theme {
            --font-mulish: "Mulish", sans-serif;
        }
    </style>
    <style>
        body {
            font-family: 'Mulish', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 font-mulish min-h-screen">
    <!-- Navbar -->
    <nav class="mb-16 xl:mb-24 sticky top-0 z-50 bg-secondary/70 backdrop-blur-md shadow-lg shadow-primary/20 border-b border-primary/30 transition-all duration-300"
        data-aos="fade-down" data-aos-delay="500">
        <div class="mx-auto max-w-7xl px-4 sm:px-8 lg:px-12">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <a href="./index.html" class="flex items-center gap-3 group">
                    <img class="h-10 w-auto transition-transform duration-200 group-hover:scale-110"
                        src="./img/icon/icon.png"
                        alt="Logo Amerta" />
                    <span
                        class="text-white text-lg font-bold leading-5 tracking-wide group-hover:text-primary transition-colors duration-200">
                        AMERTA<br><span
                            class="text-xs font-semibold tracking-widest text-primary">NIGHT SHOW</span>
                    </span>
                </a>
                <!-- Menu (future use, hidden for now) -->
                <div class="hidden md:flex gap-8 items-center">
                    <!-- Tambahkan menu di sini jika perlu -->
                </div>
                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    <a href="./contact.html"
                        class="bg-gradient-to-r from-secondary via-primary to-secondary text-white font-bold px-5 py-2 rounded-lg shadow-md transition duration-200 hover:shadow-lg hover:from-primary hover:to-primary focus:outline-none focus:ring-2 focus:ring-primary">
                        CONTACT US
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-2xl w-full mx-auto px-4 flex flex-col items-center justify-center">
        <div class="w-full bg-slate-900/80 rounded-2xl shadow-2xl shadow-blue-900/30 p-8 lg:p-12 mb-12" data-aos="zoom-in" data-aos-delay="200">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4 text-blue-300 tracking-wide text-center" data-aos="fade-up" data-aos-delay="300">Formulir Pendaftaran</h2>
            <div id="countdownContainer" class="mb-8 text-center countdown-wrapper" data-target-date="2025-06-29T11:00:00">
                <div class="coming-soon-text text-2xl md:text-3xl font-extrabold text-blue-400 mb-2 animate-pulse">Coming Soon</div>
                <div class="countdown-text text-base md:text-lg text-slate-300 mb-2">Waktu pendaftaran akan dibuka dalam:</div>
                <div id="countdownTimer" class="flex justify-center gap-3 md:gap-6">
                    <div class="time-segment bg-blue-900/30 border-2 border-blue-500 rounded-xl px-4 py-3 flex flex-col items-center min-w-[60px]">
                        <span id="days" class="text-2xl md:text-3xl font-bold text-blue-300">--</span>
                        <span class="text-xs md:text-sm text-blue-200 mt-1">Hari</span>
                    </div>
                    <div class="time-segment bg-blue-900/30 border-2 border-blue-500 rounded-xl px-4 py-3 flex flex-col items-center min-w-[60px]">
                        <span id="hours" class="text-2xl md:text-3xl font-bold text-blue-300">--</span>
                        <span class="text-xs md:text-sm text-blue-200 mt-1">Jam</span>
                    </div>
                    <div class="time-segment bg-blue-900/30 border-2 border-blue-500 rounded-xl px-4 py-3 flex flex-col items-center min-w-[60px]">
                        <span id="minutes" class="text-2xl md:text-3xl font-bold text-blue-300">--</span>
                        <span class="text-xs md:text-sm text-blue-200 mt-1">Menit</span>
                    </div>
                    <div class="time-segment bg-blue-900/30 border-2 border-blue-500 rounded-xl px-4 py-3 flex flex-col items-center min-w-[60px]">
                        <span id="seconds" class="text-2xl md:text-3xl font-bold text-blue-300">--</span>
                        <span class="text-xs md:text-sm text-blue-200 mt-1">Detik</span>
                    </div>
                </div>
            </div>
            <form id="bookingForm" class="space-y-5" method="POST" novalidate style="display:none;" data-aos="fade-up" data-aos-delay="400">
                <div>
                    <label for="nama_wali" class="block text-blue-200 font-semibold mb-1">Nama Wali</label>
                    <input type="text" class="w-full rounded-lg border border-blue-700 bg-slate-800 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" id="nama_wali" name="nama_wali" placeholder="Masukkan nama wali" required>
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-blue-200 font-semibold mb-1">Jenis Kelamin</label>
                    <select class="w-full rounded-lg border border-blue-700 bg-slate-800 text-white px-4 py-2" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-blue-200 font-semibold mb-1">Kelas</label>
                    <div id="kelas-utama-options" class="flex flex-wrap gap-2 text-slate-100"></div>
                </div>
                <div id="subkelas-container" style="display:none;">
                    <label class="block text-blue-200 font-semibold mb-1"></label>
                    <div id="subkelas-options" class="flex flex-wrap gap-2 text-slate-100"></div>
                </div>
                <input type="hidden" name="kelas_murid" id="kelas_murid" required>
                <div>
                    <label for="nama_murid" class="block text-blue-200 font-semibold mb-1">Nama Santri</label>
                    <select class="w-full rounded-lg border border-blue-700 bg-slate-800 text-white px-4 py-2" name="nama_murid" id="nama_murid" required disabled>
                        <option value="">Pilih Santri</option>
                    </select>
                </div>
                <div>
                    <label for="status_menginap" class="block text-blue-200 font-semibold mb-1">Status Menginap</label>
                    <select class="w-full rounded-lg border border-blue-700 bg-slate-800 text-white px-4 py-2" name="status_menginap" id="status_menginap" required>
                        <option value="">Pilih Status Menginap</option>
                        <option value="Menginap">Menginap</option>
                        <option value="Tidak menginap">Tidak Menginap</option>
                    </select>
                </div>
                <div>
                    <label for="no_wa" class="block text-blue-200 font-semibold mb-1">Nomor WhatsApp</label>
                    <input type="tel" class="w-full rounded-lg border border-blue-700 bg-slate-800 text-white px-4 py-2" id="no_wa" name="no_wa" placeholder="Contoh: 08123456789" required pattern="628[0-9]{9,13}">
                </div>
                <button type="submit" id="bookingButton" class="w-full bg-gradient-to-r from-blue-700 via-blue-500 to-sky-700 text-lg font-bold py-3 rounded-xl text-white shadow-lg transition duration-300 hover:shadow-xl hover:from-blue-800 hover:to-sky-800" data-aos="zoom-in" data-aos-delay="600">Booking Sekarang</button>
            </form>
        </div>
    </main>
    <footer class="bg-slate-900 text-white py-8 mt-16" data-aos="fade-up" data-aos-delay="800">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm text-slate-400">
            ©2025 amertans.au All Rights Reserved. | <a href="#" class="text-blue-400 hover:underline">Terms & Privacy Policy</a>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kelasUtamaList = ['7', '8', '9', '10', '11', '12'];
            const subkelasMap = {
                '7': ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
                '8': ['A', 'B', 'C', 'D', 'E', 'F'],
                '9': ['A', 'B', 'C', 'D', 'E'],
                '10': [' A', ' B', ' C', ' D'],
                '11': [' A', ' B', ' C', ' D'],
                '12': [' A', ' B', ' C', ' D']
            };

            const kelasUtamaContainer = document.getElementById('kelas-utama-options');
            const subkelasContainer = document.getElementById('subkelas-options');
            const subkelasWrapper = document.getElementById('subkelas-container');
            const hiddenInput = document.getElementById('kelas_murid');
            const namaMuridSelect = document.getElementById('nama_murid');

            // Initialize kelas utama checkboxes
            kelasUtamaList.forEach(mainClass => {
                const checkboxId = `kelas_utama_${mainClass}`;
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.id = checkboxId;
                checkbox.name = 'kelas_utama';
                checkbox.value = mainClass;
                checkbox.classList.add('form-check-input');
                checkbox.addEventListener('change', () => {
                    // Only allow one kelas utama checkbox to be selected at a time
                    document.querySelectorAll('input[name="kelas_utama"]').forEach(cb => {
                        if (cb !== checkbox) cb.checked = false;
                    });

                    if (checkbox.checked) {
                        showSubkelas(mainClass);
                    } else {
                        subkelasWrapper.style.display = 'none';
                        subkelasContainer.innerHTML = '';
                        hiddenInput.value = '';
                        namaMuridSelect.innerHTML = '<option value="">Pilih Santri</option>';
                        namaMuridSelect.disabled = true;
                    }
                });

                const label = document.createElement('label');
                label.htmlFor = checkboxId;
                label.classList.add('form-check-label', 'me-3', 'mb-0');
                label.style.cursor = 'pointer';
                label.textContent = mainClass;

                const div = document.createElement('div');
                div.classList.add('form-check');
                div.appendChild(checkbox);
                div.appendChild(label);

                kelasUtamaContainer.appendChild(div);
            });

            function showSubkelas(mainClass) {
                // Reset subkelas options and hidden input
                subkelasContainer.innerHTML = '';
                hiddenInput.value = '';
                namaMuridSelect.innerHTML = '<option value="">Pilih Santri</option>';
                namaMuridSelect.disabled = true;

                if (!mainClass || !subkelasMap[mainClass]) {
                    subkelasWrapper.style.display = 'none';
                    hiddenInput.required = false;
                    return;
                }

                subkelasWrapper.style.display = 'block';
                hiddenInput.required = true;

                subkelasMap[mainClass].forEach(sub => {
                    const checkboxId = `subkelas_${mainClass}${sub}`;
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = checkboxId;
                    checkbox.name = 'subkelas';
                    checkbox.value = sub;
                    checkbox.classList.add('form-check-input');
                    checkbox.addEventListener('change', () => {
                        // Only allow one checkbox to be selected at a time
                        document.querySelectorAll('input[name="subkelas"]').forEach(cb => {
                            if (cb !== checkbox) cb.checked = false;
                        });

                        if (checkbox.checked) {
                            hiddenInput.value = mainClass + sub;
                            loadSantri(hiddenInput.value);
                        } else {
                            hiddenInput.value = '';
                            namaMuridSelect.innerHTML = '<option value="">Pilih Santri</option>';
                            namaMuridSelect.disabled = true;
                        }
                    });

                    const label = document.createElement('label');
                    label.htmlFor = checkboxId;
                    label.classList.add('form-check-label', 'me-3', 'mb-0');
                    label.style.cursor = 'pointer';
                    label.textContent = sub;

                    const div = document.createElement('div');
                    div.classList.add('form-check');
                    div.appendChild(checkbox);
                    div.appendChild(label);

                    subkelasContainer.appendChild(div);
                });
            }

            function loadSantri(kelas) {
                namaMuridSelect.disabled = true;
                namaMuridSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`get_santri.php?kelas=${kelas}`)
                    .then(response => response.json())
                    .then data => {
                        namaMuridSelect.innerHTML = '<option value="">Pilih Santri</option>';
                        data.forEach(santri => {
                            namaMuridSelect.innerHTML += `<option value="${santri.nama}">${santri.nama}</option>`;
                        });
                        namaMuridSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        namaMuridSelect.innerHTML = '<option value="">Error loading santri</option>';
                    });
            }

            // Pass PHP visitor count and limit to JS
            const visitorCount = <?php echo $visitor_count; ?>;
            const visitorLimit = <?php echo $visitor_limit; ?>;

            document.getElementById('bookingButton').addEventListener('click', function(event) {
                if (visitorCount >= visitorLimit) {
                    event.preventDefault();
                    alert('Maaf, kuota pengunjung sudah mencapai batas maksimal. Pendaftaran ditutup.');
                }
            });

            // Convert no_wa input from 0... to 62... on form submit
            document.getElementById('bookingForm').addEventListener('submit', function(event) {
                const noWaInput = document.getElementById('no_wa');
                let noWaValue = noWaInput.value.trim();

                if (noWaValue.startsWith('0')) {
                    noWaValue = '62' + noWaValue.substring(1);
                    noWaInput.value = noWaValue;
                }
            });

            // Countdown timer logic
            const countdownTimer = document.getElementById('countdownTimer');
            const countdownContainer = document.getElementById('countdownContainer');
            const bookingForm = document.getElementById('bookingForm');
            let targetDateStr = countdownContainer ? countdownContainer.getAttribute('data-target-date') : null;
            let countDownDate = targetDateStr ? new Date(targetDateStr.replace(/-/g, '/')).getTime() : null;

            function updateTimer() {
                const now = new Date().getTime();
                const distance = countDownDate - now;
                if (distance <= 0) {
                    if (countdownContainer) countdownContainer.style.display = 'none';
                    if (bookingForm) bookingForm.style.display = 'block';
                    clearInterval(timerInterval);
                    return;
                }
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                if (document.getElementById('days')) document.getElementById('days').textContent = days.toString().padStart(2, '0');
                if (document.getElementById('hours')) document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                if (document.getElementById('minutes')) document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                if (document.getElementById('seconds')) document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }
            if (countDownDate && Date.now() >= countDownDate) {
                if (countdownContainer) countdownContainer.style.display = 'none';
                if (bookingForm) bookingForm.style.display = 'block';
            } else if (countDownDate) {
                updateTimer();
                var timerInterval = setInterval(updateTimer, 1000);
            } else {
                // Fallback: always show form if no countdown
                if (countdownContainer) countdownContainer.style.display = 'none';
                if (bookingForm) bookingForm.style.display = 'block';
            }
        });
    </script>
</body>

</html>