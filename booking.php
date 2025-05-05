<?php
require_once 'vendor/autoload.php';
include './config/db.php'; // Include your database connection file if needed


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $data = [
        'nama_wali' => htmlspecialchars($_POST['nama_wali']),
        'jenis_kelamin' => htmlspecialchars($_POST['jenis_kelamin']),
        'kelas_murid' => htmlspecialchars($_POST['kelas_murid']),
        'nama_murid' => htmlspecialchars($_POST['nama_murid']),
        'status_menginap' => htmlspecialchars($_POST['status_menginap']),
        'no_wa' => htmlspecialchars($_POST['no_wa'])
    ];

    // Determine seat number range based on gender
    $gender_range = ($data['jenis_kelamin'] === 'L') ? [1, 125] : [126, 250];
    
    // Find available seat
    $sql_seat = "SELECT nomor_kursi FROM pengunjung 
                 WHERE nomor_kursi BETWEEN ? AND ? 
                 ORDER BY nomor_kursi ASC";
    $stmt = mysqli_prepare($conn, $sql_seat);
    mysqli_stmt_bind_param($stmt, "ii", $gender_range[0], $gender_range[1]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $taken_seats = [];
    while($row = mysqli_fetch_assoc($result)) {
        $taken_seats[] = $row['nomor_kursi'];
    }
    
    // Find first available seat number
    $seat_number = null;
    for($i = $gender_range[0]; $i <= $gender_range[1]; $i++) {
        if(!in_array($i, $taken_seats)) {
            $seat_number = $i;
            break;
        }
    }
    
    if($seat_number === null) {
        echo '<script>alert("Maaf, kursi untuk kategori ini sudah penuh."); window.location.href="booking.php";</script>';
        exit;
    }

    // Insert booking data
    $sql = "INSERT INTO pengunjung (nama, jk, kelas, nama_murid, status, no_wa, nomor_kursi) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", 
        $data['nama_wali'],
        $data['jenis_kelamin'],
        $data['kelas_murid'],
        $data['nama_murid'],
        $data['status_menginap'],
        $data['no_wa'],
        $seat_number
    );
    
    if(mysqli_stmt_execute($stmt)) {
        $inserted_id = mysqli_insert_id($conn);
        
        // Update jumlah_terpilih
        $update_sql = "UPDATE murid SET jumlah_terpilih = COALESCE(jumlah_terpilih, 0) + 1 WHERE nama = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "s", $data['nama_murid']);
        mysqli_stmt_execute($update_stmt);
        mysqli_stmt_close($update_stmt);

        // Send WhatsApp message
        include 'send_whatsapp.php';
        sendWhatsAppMessage($data, $seat_number);

        // Redirect to confirmation page
        header("Location: konfirmasi.php?id=" . $inserted_id);
        exit;
    } else {
        echo '<script>alert("Terjadi kesalahan saat menyimpan data."); window.location.href="booking.php";</script>';
    }
    
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMERTA - Booking Tickets</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> -->
    
    <style>
        .neon-text {
            text-shadow: 0 0 10px #025f92, 0 0 20px #025f92, 0 0 30px #025f92;
        }
        
        .neon-border {
            box-shadow: 0 0 15px #025f92, inset 0 0 15px #025f92;
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #00171f;
            color: white;
        }
        
        .title-font {
            font-family: 'Orbitron', sans-serif;
        }
        
        @keyframes neonPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .neon-pulse {
            animation: neonPulse 2s infinite;
        }
    </style>
</head>
<body class="bg-[#00171f]">
    <!-- Sticky Navbar -->
    <nav class="fixed w-full z-50 bg-black/80 backdrop-blur-md py-4 shadow-lg transition-all duration-300">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="index.php" class="title-font text-2xl neon-text">AMERTA</a>
            <div class="space-x-8">
                <a href="index.php" class="text-white hover:text-[#025f92] transition-colors">Back to Home</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Parallax -->
    <section class="min-h-[40vh] flex items-center justify-center parallax-bg" 
             style="background-image: linear-gradient(rgba(0,23,31,0.9), rgba(0,23,31,0.9)), url('https://source.unsplash.com/random/1920x1080/?concert');">
        <div class="container mx-auto px-6 text-center" data-aos="fade-up">
            <h1 class="title-font text-5xl mb-6 neon-text">Book Your Tickets</h1>
            <p class="text-xl mb-8">Secure your spot for the most spectacular show of the year</p>
        </div>
    </section>

    <!-- Ticket Section -->
    <section id="tickets" class="py-20 bg-[#025f92]/10">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto" data-aos="zoom-in">
                <h2 class="title-font text-4xl mb-6 neon-text text-center">Form Pembelian Tiket</h2>

                <form class="space-y-6 bg-black/30 p-8 rounded-xl neon-border backdrop-blur-md" method="POST" id="bookingForm" data-aos="fade-up">
                    <!-- Existing form fields with enhanced styling -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama Wali -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Nama Wali</label>
                            <input type="text" name="nama_wali" required
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none transition-all border border-[#025f92]/30"
                                placeholder="Nama lengkap wali">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none border border-[#025f92]/30">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Kelas Murid -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Kelas Murid</label>
                            <select name="kelas_murid" id="kelas_murid" required onchange="loadSantri(this.value)"
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none border border-[#025f92]/30">
                                <option value="">Pilih Kelas</option>
                                <?php
                                $kelas = [
                                    '7' => ['A','B','C','D','E','F','G','H'],
                                    '8' => ['A','B','C','D','E','F'],
                                    '9' => ['A','B','C','D','E'],
                                    '10' => ['A','B','C','D'],
                                    '11' => ['A','B','C','D'],
                                    '12' => ['A','B','C','D']
                                ];
                                
                                foreach($kelas as $tingkat => $subkelas) {
                                    foreach($subkelas as $suffix) {
                                        $kelas_id = $tingkat . $suffix;
                                        echo "<option value=\"$kelas_id\">{$kelas_id}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Nama Santri -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Nama Santri</label>
                            <select name="nama_murid" id="nama_murid" required disabled
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none border border-[#025f92]/30">
                                <option value="">Pilih Santri</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Status Menginap -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Status Menginap</label>
                            <select name="status_menginap" required
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none border border-[#025f92]/30">
                                <option value="">Pilih Status Menginap</option>
                                <option value="Menginap">Menginap</option>
                                <option value="Tidak menginap">Tidak Menginap</option>
                            </select>
                        </div>

                        <!-- Nomor WA -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-[#025f92]">Nomor WhatsApp</label>
                            <input type="tel" name="no_wa" required
                                class="w-full px-4 py-3 bg-[#1b425c]/50 rounded-lg focus:ring-2 focus:ring-[#025f92] outline-none border border-[#025f92]/30"
                                placeholder="Contoh: 628123456789"
                                pattern="628[0-9]{9,13}">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#025f92] hover:bg-[#1b425c] py-3 rounded-lg transition-all duration-300 neon-border neon-pulse mt-8">
                        Booking Ticket
                    </button>
                </form>


            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/80 py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400">&copy; 2024 AMERTA. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-xl');
                nav.classList.add('bg-black/90');
            } else {
                nav.classList.remove('shadow-xl');
                nav.classList.remove('bg-black/90');
            }
        });

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