<?php
require_once 'vendor/autoload.php';
include './config/db.php';

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

        // Determine seat range based on gender
        $gender_range = ($data['jenis_kelamin'] === 'L') ? [1, 125] : [126, 250];

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

    <!-- bootstrap grid css -->
    <link rel="stylesheet" href="css/plugins/bootstrap-grid.css">
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/plugins/font-awesome.min.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="css/plugins/swiper.min.css">
    <!-- fancybox css -->
    <link rel="stylesheet" href="css/plugins/fancybox.min.css">
    <!-- ashley scss -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking-form.css">
    <!-- page name -->
    <title>Amerta | Booking</title>

</head>

<body>

    <!-- wrapper -->
    <div class="mil-wrapper" id="top">

        <!-- cursor -->
        <div class="mil-ball">
            <span class="mil-icon-1">
                <svg viewBox="0 0 128 128">
                    <path d="M106.1,41.9c-1.2-1.2-3.1-1.2-4.2,0c-1.2,1.2-1.2,3.1,0,4.2L116.8,61H11.2l14.9-14.9c1.2-1.2,1.2-3.1,0-4.2	c-1.2-1.2-3.1-1.2-4.2,0l-20,20c-1.2,1.2-1.2,3.1,0,4.2l20,20c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9c1.2-1.2,1.2-3.1,0-4.2	L11.2,67h105.5l-14.9,14.9c-1.2-1.2-1.2-3.1,0-4.2c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9l20-20c1.2-1.2,1.2-3.1,0-4.2L106.1,41.9	z" />
                </svg>
            </span>
            <div class="mil-more-text">More</div>
            <div class="mil-choose-text">Сhoose</div>
        </div>
        <!-- cursor end -->


        <!-- scrollbar progress -->
        <div class="mil-progress-track">
            <div class="mil-progress"></div>
        </div>
        <!-- scrollbar progress end -->

        <!-- menu -->
        <?php include 'components/menu.php'; ?>
        <!-- menu -->

        <!-- curtain -->
        <div class="mil-curtain"></div>
        <!-- curtain end -->

        <!-- frame -->
        <div class="mil-frame">
            <div class="mil-frame-top">
                <a href="index.php" class="mil-logo">A.</a>
                <div class="mil-menu-btn">
                    <span></span>
                </div>
            </div>
            <div class="mil-frame-bottom">
                <div class="mil-current-page"></div>
                <div class="mil-back-to-top">
                    <a href="#top" class="mil-link mil-dark mil-arrow-place">
                        <span>Back to top</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- frame end -->

        <!-- content -->
        <div class="mil-content">
            <div id="swupMain" class="mil-main-transition">

                <!-- banner -->
                <div class="mil-inner-banner mil-p-0-120">
                    <div class="mil-banner-content mil-center mil-up">
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                                <li><a href="index.php">Homepage</a></li>
                                <li><a href="booking.php">Booking</a></li>
                            </ul>
                            <h1 class="mil-mb-60">Book Your Tickets</h1>
                            <a href="#booking" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Book Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <!-- booking form -->
                <section id="booking">
                    <div class="container mil-p-120-90">
                        <h3 class="mil-center mil-up mil-mb-120">Form Pembelian Tiket</h3>
                        <form id="bookingForm" class="row align-items-center booking-form" method="POST">
                            <div class="col-lg-6 mil-up form-group">
                                <label for="nama_wali">Nama Wali</label>
                                <input type="text" id="nama_wali" name="nama_wali" placeholder="Masukkan nama wali" required>
                            </div>
                            
                            <div class="col-lg-6 mil-up form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mil-up form-group">
                                <label for="kelas_murid">Kelas</label>
                                <select name="kelas_murid" id="kelas_murid" required onchange="loadSantri(this.value)">
                                    <option value="">Pilih Kelas</option>
                                    <?php
                                    $kelas = [
                                        '7' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
                                        '8' => ['A', 'B', 'C', 'D', 'E', 'F'],
                                        '9' => ['A', 'B', 'C', 'D', 'E'],
                                        '10 ' => ['A', 'B', 'C', 'D'],
                                        '11 ' => ['A', 'B', 'C', 'D'],
                                        '12 ' => ['A', 'B', 'C', 'D']
                                    ];
                                    foreach ($kelas as $tingkat => $subkelas) {
                                        foreach ($subkelas as $suffix) {
                                            $kelas_id = $tingkat . $suffix;
                                            echo "<option value=\"$kelas_id\">{$kelas_id}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-6 mil-up form-group">
                                <label for="nama_murid">Nama Santri</label>
                                <select name="nama_murid" id="nama_murid" required disabled>
                                    <option value="">Pilih Santri</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mil-up form-group">
                                <label for="status_menginap">Status Menginap</label>
                                <select name="status_menginap" id="status_menginap" required>
                                    <option value="">Pilih Status Menginap</option>
                                    <option value="Menginap">Menginap</option>
                                    <option value="Tidak menginap">Tidak Menginap</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mil-up form-group">
                                <label for="no_wa">Nomor WhatsApp</label>
                                <input type="tel" id="no_wa" name="no_wa" placeholder="Contoh: 628123456789" required pattern="628[0-9]{9,13}">
                            </div>

                            <div class="col-lg-8">
                                <p class="mil-up mil-mb-30"><span class="mil-accent">*</span> Kami akan menghubungi Anda melalui WhatsApp.</p>
                            </div>

                            <div class="col-lg-4">
                                <div class="mil-adaptive-right mil-up mil-mb-30">
                                    <button type="submit" class="mil-button mil-arrow-place">
                                        <span>Booking Ticket</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- booking form end -->

                <!-- hidden elements -->
                <div class="mil-hidden-elements">
                    <div class="mil-dodecahedron">
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="mil-pentagon">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                        <path d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z" />
                    </svg>

                    <svg width="250" viewBox="0 0 300 1404" fill="none" xmlns="http://www.w3.org/2000/svg" class="mil-lines">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1 892L1 941H299V892C299 809.71 232.29 743 150 743C67.7096 743 1 809.71 1 892ZM0 942H300V892C300 809.157 232.843 742 150 742C67.1573 742 0 809.157 0 892L0 942Z" class="mil-move" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M299 146V97L1 97V146C1 228.29 67.7096 295 150 295C232.29 295 299 228.29 299 146ZM300 96L0 96V146C0 228.843 67.1573 296 150 296C232.843 296 300 228.843 300 146V96Z" class="mil-move" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M299 1H1V1403H299V1ZM0 0V1404H300V0H0Z" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M150 -4.37115e-08L150 1404L149 1404L149 0L150 -4.37115e-08Z" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M150 1324C232.29 1324 299 1257.29 299 1175C299 1092.71 232.29 1026 150 1026C67.7096 1026 1 1092.71 1 1175C1 1257.29 67.7096 1324 150 1324ZM150 1325C232.843 1325 300 1257.84 300 1175C300 1092.16 232.843 1025 150 1025C67.1573 1025 0 1092.16 0 1175C0 1257.84 67.1573 1325 150 1325Z" class="mil-move" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M300 1175H0V1174H300V1175Z" class="mil-move" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M150 678C232.29 678 299 611.29 299 529C299 446.71 232.29 380 150 380C67.7096 380 1 446.71 1 529C1 611.29 67.7096 678 150 678ZM150 679C232.843 679 300 611.843 300 529C300 446.157 232.843 379 150 379C67.1573 379 0 446.157 0 529C0 611.843 67.1573 679 150 679Z" class="mil-move" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M299 380H1V678H299V380ZM0 379V679H300V379H0Z" class="mil-move" />
                    </svg>
                </div>
                <!-- hidden elements end -->

            </div>
        </div>
        <!-- content -->
    </div>
    <!-- wrapper end -->

    <!-- jQuery js -->
    <script src="js/plugins/jquery.min.js"></script>
    <!-- swup js -->
    <script src="js/plugins/swup.min.js"></script>
    <!-- swiper js -->
    <script src="js/plugins/swiper.min.js"></script>
    <!-- fancybox js -->
    <script src="js/plugins/fancybox.min.js"></script>
    <!-- gsap js -->
    <script src="js/plugins/gsap.min.js"></script>
    <!-- scroll smoother -->
    <script src="js/plugins/smooth-scroll.js"></script>
    <!-- scroll trigger js -->
    <script src="js/plugins/ScrollTrigger.min.js"></script>
    <!-- scroll to js -->
    <script src="js/plugins/ScrollTo.min.js"></script>
    <!-- ashley js -->
    <script src="js/main.js"></script>

    <script>
        function loadSantri(kelas) {
            const santriSelect = document.getElementById('nama_murid');
            santriSelect.disabled = true;
            santriSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`get_santri.php?kelas=${kelas}`)
                .then(response => response.json())
                .then(data => {
                    santriSelect.innerHTML = '<option value="">Pilih Santri</option>';
                    data.forEach(santri => {
                        santriSelect.innerHTML += `<option value="${santri.nama}">${santri.nama}</option>`;
                    });
                    santriSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    santriSelect.innerHTML = '<option value="">Error loading santri</option>';
                });
        }
    </script>

</body>

</html>