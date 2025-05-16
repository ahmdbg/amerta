<?php
require_once 'vendor/autoload.php';
include 'config/db.php';

// Check total visitors count
$visitor_limit = 95;
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
    </style>

</head>

<body>

    <?php
    // Removed PHP countdown visibility logic to rely solely on JavaScript
    ?>

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

                <div id="countdownContainer" class="mb-4 text-center" style="font-size: 1.5rem; font-weight: bold; color: #fff;" data-target-date="2025-05-14T09:00:00">
                    Waktu pendaftaran akan dibuka dalam: <span id="countdownTimer">--:--</span>
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
                alert('Maaf, kuota pengunjung sudah mencapai batas maksimal. Pendaftaran ditutup. Silahkan coba lagi di batch 2');
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
                countdownTimer.textContent =
                    `${days.toString().padStart(2, '0')} hari ` +
                    `${hours.toString().padStart(2, '0')}:` +
                    `${minutes.toString().padStart(2, '0')}:` +
                    `${seconds.toString().padStart(2, '0')}`;
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