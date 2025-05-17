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
<html lang="zxx">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/booking-form.css">
    <!-- page name -->
    <title>Amerta | Booking</title>

    <style>
        body {
            background: #343434;
            background-size: 400% 400%;
            animation: aurora 15s ease infinite;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Countdown styles */
        .countdown-wrapper {
            font-family: 'Poppins', sans-serif;
            color: #cce0ff;
            text-align: center;
            user-select: none;
            animation: pulseGlow 2.5s ease-in-out infinite;
        }

        .coming-soon-text {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 0.3em;
            color: #4a90e2;
            text-shadow:
                0 0 10px #4a90e2,
                0 0 20px #4a90e2,
                0 0 30px #4a90e2,
                0 0 40px #4a90e2;
            margin-bottom: 0.5rem;
            animation: flicker 3s infinite;
        }

        .countdown-text {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #cce0ff;
            text-shadow: 0 0 5px #000;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .time-segment {
            background: rgba(74, 144, 226, 0.15);
            border: 2px solid #4a90e2;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            min-width: 70px;
            width: 100px;
            box-shadow:
                0 0 10px #4a90e2,
                inset 0 0 8px #4a90e2;
            animation: glowPulse 2s ease-in-out infinite;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 576px) {
            .time-segment {
                width: 70px;
                padding: 0.5rem 1rem;
                min-width: 70px;
            }

            .time-number {
                font-size: 1.8rem;
            }

            .time-label {
                font-size: 0.75rem;
            }

            .coming-soon-text {
                font-size: 1.8rem;
                letter-spacing: 0.2em;
            }

            .countdown-text {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }

            .form-left {
                padding: 2rem 1rem;
            }
        }

        .time-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: #4a90e2;
            text-shadow:
                0 0 5px #4a90e2,
                0 0 10px #4a90e2;
        }

        .time-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #a3c1ff;
            margin-top: 0.25rem;
            letter-spacing: 0.1em;
        }

        /* Animations */
        @keyframes pulseGlow {
            0%, 100% {
                text-shadow: 0 0 10px #4a90e2, 0 0 20px #4a90e2;
            }
            50% {
                text-shadow: 0 0 20px #4a90e2, 0 0 40px #4a90e2;
            }
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow:
                    0 0 10px #4a90e2,
                    inset 0 0 8px #4a90e2;
            }
            50% {
                box-shadow:
                    0 0 20px #4a90e2,
                    inset 0 0 16px #4a90e2;
            }
        }

        @keyframes flicker {
            0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
                opacity: 1;
            }
            20%, 22%, 24%, 55% {
                opacity: 0.4;
            }
        }
    </style>

</head>

<body>

<?php
// Removed PHP countdown visibility logic to rely solely on JavaScript
?>

    <!-- home icon top right -->
    <a href="index.php" style="position: fixed; top: 10px; right: 10px; z-index: 1000; text-decoration: none; color: #000;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0L1 7.793V14.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V11h2v3.5A1.5 1.5 0 0 0 10.5 16h3a1.5 1.5 0 0 0 1.5-1.5V7.793l-6.646-6.647zM2 14V8.5l6-6 6 6V14a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V11H6v3.5a.5.5 0 0 1-.5.5h-3A.5.5 0 0 1 2 14z"/>
        </svg>
    </a>

    <!-- wrapper -->
    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <!-- form container -->
        <div class="booking-container d-flex rounded-4 shadow-lg overflow-hidden" style="max-width: 900px; width: 100%; background: #f8f9fa;">

            <!-- left image side -->

            <div class="form-right d-none d-md-block" style="flex: 1 1 50%; background: url('img/works/2.webp') center center/cover no-repeat; border-top-right-radius: 1rem; border-bottom-right-radius: 1rem;">
            </div>
            <!-- right side -->
            <div class="form-left p-5" style="flex: 1 1 50%;">

                <h3 class="form-title mb-4 fw-semibold text-white text-center">Registration form</h3>

                <div id="countdownContainer" class="mb-4 text-center countdown-wrapper" data-target-date="2025-05-18T09:00:00">
                    <div class="coming-soon-text">Coming Soon</div>
                    <div class="countdown-text">Waktu pendaftaran akan dibuka dalam:</div>
                    <div id="countdownTimer" class="countdown-timer">
                        <div class="time-segment">
                            <span id="days" class="time-number">--</span>
                            <span class="time-label">Hari</span>
                        </div>
                        <div class="time-segment">
                            <span id="hours" class="time-number">--</span>
                            <span class="time-label">Jam</span>
                        </div>
                        <div class="time-segment">
                            <span id="minutes" class="time-number">--</span>
                            <span class="time-label">Menit</span>
                        </div>
                        <div class="time-segment">
                            <span id="seconds" class="time-number">--</span>
                            <span class="time-label">Detik</span>
                        </div>
                    </div>
                </div>

                <form id="bookingForm" class="booking-form" method="POST" novalidate style="display:none;">
                    <div class="mb-3">
                        <label for="nama_wali" class="form-label required">Nama Wali</label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Masukkan nama wali" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label required">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3 kelas-utama-group">
                        <label class="form-label required d-block">Kelas</label>
                        <div id="kelas-utama-options" class="d-flex flex-wrap gap-3">
                            <!-- Kelas Utama checkboxes will be dynamically inserted here -->
                        </div>
                    </div>

                    <div class="mb-3" id="subkelas-container" style="display:none;">
                        <label class="form-label required d-block"></label>
                        <div id="subkelas-options" class="d-flex flex-wrap gap-3">
                            <!-- Subkelas checkboxes will be dynamically inserted here -->
                        </div>
                    </div>

                    <input type="hidden" name="kelas_murid" id="kelas_murid" required>

                    <div class="mb-3">
                        <label for="nama_murid" class="form-label required">Nama Santri</label>
                        <select class="form-select" name="nama_murid" id="nama_murid" required disabled>
                            <option value="">Pilih Santri</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status_menginap" class="form-label required">Status Menginap</label>
                        <select class="form-select" name="status_menginap" id="status_menginap" required>
                            <option value="">Pilih Status Menginap</option>
                            <option value="Menginap">Menginap</option>
                            <option value="Tidak menginap">Tidak Menginap</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="no_wa" class="form-label required">Nomor WhatsApp</label>
                        <input type="tel" class="form-control" id="no_wa" name="no_wa" placeholder="Contoh: 08123456789" required pattern="628[0-9]{9,13}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 text-uppercase fw-semibold" id="bookingButton">
                        Booking Sekarang
                    </button>
                </form>

            </div>

        </div>

    </div>

    <script>
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
                .then(data => {
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
    </script>

    <script>
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
        (function() {
            const countdownTimer = document.getElementById('countdownTimer');
            const countdownContainer = document.getElementById('countdownContainer');
            const bookingForm = document.getElementById('bookingForm');
            const targetDateStr = countdownContainer.getAttribute('data-target-date');
            const countDownDate = new Date(targetDateStr).getTime();

            function updateTimer() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                if (distance <= 0) {
                    clearInterval(timerInterval);
                    countdownContainer.style.display = 'none';
                    bookingForm.style.display = 'block';
                    return;
                }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format as DD HH:MM:SS
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));

            // Update each segment separately
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }

        // Immediately check if countdown has passed and show form if so
        if (Date.now() >= countDownDate) {
            countdownContainer.style.display = 'none';
            bookingForm.style.display = 'block';
        } else {
            updateTimer();
            var timerInterval = setInterval(updateTimer, 1000);
        }
    })();
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>