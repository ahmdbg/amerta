<?php
require_once 'vendor/autoload.php';
include 'config/db.php';

// Check total donors count
$visitor_limit = 95;
$visitor_count = 0;
$count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengunjung_donatur");
if ($count_result) {
    $row = mysqli_fetch_assoc($count_result);
    $visitor_count = (int)$row['total'];
}

// Fetch donatur names for dropdown
$donatur_result = mysqli_query($conn, "SELECT nama_donatur FROM donatur ORDER BY nama_donatur ASC");
$donaturs = [];
if ($donatur_result) {
    while ($row = mysqli_fetch_assoc($donatur_result)) {
        $donaturs[] = $row['nama_donatur'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        mysqli_begin_transaction($conn);

        // Get and sanitize form data using array_map
        $data = array_map('htmlspecialchars', [
            'nama_wali' => $_POST['nama_wali'] ?? '',
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
        $count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengunjung_donatur");
        if ($count_result) {
            $row = mysqli_fetch_assoc($count_result);
            $current_visitor_count = (int)$row['total'];
            if ($current_visitor_count >= $visitor_limit) {
                throw new Exception("Maaf, kuota donatur sudah mencapai batas maksimal. Pendaftaran ditutup.");
            }
        } else {
            throw new Exception("Gagal memeriksa kuota donatur.");
        }

        // Prepare insert statement
        $sql = "INSERT INTO pengunjung_donatur (nama, status, no_wa) 
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $data['nama_wali'],
            $data['status_menginap'],
            $data['no_wa']
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to insert booking data");
        }

        $inserted_id = mysqli_insert_id($conn);

        // Commit transaction
        mysqli_commit($conn);

        // Send WhatsApp message asynchronously
        include 'send_whatsapp_donatur.php';
        sendWhatsAppMessageDonatur($data, $inserted_id);

        header("Location: konfirmasi_donatur.php?id=" . $inserted_id);
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('" . htmlspecialchars($e->getMessage()) . "'); window.location.href='booking_donatur.php';</script>";
        exit;
    } finally {
        if (isset($stmt)) mysqli_stmt_close($stmt);
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
    <title>Amerta | Booking Donatur</title>

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

    <!-- wrapper -->
    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <!-- form container -->
        <div class="booking-container d-flex rounded-4 shadow-lg overflow-hidden" style="max-width: 600px; width: 100%; background: #f8f9fa;">

            <!-- right side -->
            <div class="form-left p-5" style="flex: 1 1 100%;">

                <h3 class="form-title mb-4 fw-semibold text-white text-center">Form Pendaftaran Donatur</h3>

                <form id="bookingForm" class="booking-form" method="POST" novalidate>
                    <div class="mb-3 position-relative">
                        <label for="nama_wali" class="form-label required">Nama Donatur</label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Ketik nama donatur" autocomplete="off" required>
                        <div id="suggestions" class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;"></div>
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
        // Pass PHP visitor count and limit to JS
        const visitorCount = <?php echo $visitor_count; ?>;
        const visitorLimit = <?php echo $visitor_limit; ?>;

        document.getElementById('bookingButton').addEventListener('click', function(event) {
            if (visitorCount >= visitorLimit) {
                event.preventDefault();
                alert('Maaf, kuota donatur sudah mencapai batas maksimal. Pendaftaran ditutup.');
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

        // Autocomplete for nama_wali input
        const namaWaliInput = document.getElementById('nama_wali');
        const suggestionsBox = document.getElementById('suggestions');

        let debounceTimeout = null;

        namaWaliInput.addEventListener('input', function() {
            const query = this.value.trim();
            if (debounceTimeout) clearTimeout(debounceTimeout);

            if (query.length === 0) {
                suggestionsBox.style.display = 'none';
                suggestionsBox.innerHTML = '';
                return;
            }

            debounceTimeout = setTimeout(() => {
                fetch(`search_donatur.php?term=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsBox.innerHTML = '';
                        if (data.length === 0) {
                            suggestionsBox.style.display = 'none';
                            return;
                        }
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.classList.add('list-group-item', 'list-group-item-action');
                            div.textContent = item;
                            div.addEventListener('click', () => {
                                namaWaliInput.value = item;
                                suggestionsBox.style.display = 'none';
                                suggestionsBox.innerHTML = '';
                            });
                            suggestionsBox.appendChild(div);
                        });
                        suggestionsBox.style.display = 'block';
                    })
                    .catch(() => {
                        suggestionsBox.style.display = 'none';
                        suggestionsBox.innerHTML = '';
                    });
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(event) {
            if (!namaWaliInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
                suggestionsBox.style.display = 'none';
                suggestionsBox.innerHTML = '';
            }
        });
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
