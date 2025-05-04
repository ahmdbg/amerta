<?php
require_once 'vendor/autoload.php';
include './config/db.php'; // Include your database connection file if needed

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

                <form class="space-y-6 bg-black/30 p-8 rounded-xl neon-border backdrop-blur-md" method="POST" data-aos="fade-up">
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
                                <option value="Tidak Menginap">Tidak Menginap</option>
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
                        Proses Pembelian
                    </button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get form data
                    $data = [
                        'nama_wali' => htmlspecialchars($_POST['nama_wali']),
                        'jenis_kelamin' => htmlspecialchars($_POST['jenis_kelamin']), // Will now be 'L' or 'P'
                        'kelas_murid' => htmlspecialchars($_POST['kelas_murid']),
                        'nama_murid' => htmlspecialchars($_POST['nama_murid']),
                        'status_menginap' => htmlspecialchars($_POST['status_menginap']),
                        'no_wa' => htmlspecialchars($_POST['no_wa'])
                    ];

                    // Determine seat number range based on gender
                    $gender_range = ($data['jenis_kelamin'] === 'L') ? [1, 125] : [126, 250];
                    
                    // Query to find the next available seat number in the gender range
                    $sql_seat = "SELECT nomor_kursi FROM pengunjung 
                                 WHERE nomor_kursi BETWEEN {$gender_range[0]} AND {$gender_range[1]}
                                 ORDER BY nomor_kursi ASC";
                    $result = mysqli_query($conn, $sql_seat);
                    
                    // Convert result to array of taken seats
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
                    
                    // Check if seat is available
                    if($seat_number === null) {
                        echo '<div class="mt-8 p-6 bg-red-500/20 rounded-lg neon-border" data-aos="fade-up">';
                        echo '<p class="text-center text-xl mb-4 title-font neon-text">Maaf!</p>';
                        echo '<p class="text-center mb-4">Kursi untuk kategori ini sudah penuh.</p>';
                        echo '</div>';
                    } else {
                        // Insert data into database
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
                            // Update jumlah_terpilih
                            $update_sql = "UPDATE murid 
                                           SET jumlah_terpilih = COALESCE(jumlah_terpilih, 0) + 1 
                                           WHERE nama = ?";
                            $update_stmt = mysqli_prepare($conn, $update_sql);
                            mysqli_stmt_bind_param($update_stmt, "s", $data['nama_murid']);
                            
                            if(mysqli_stmt_execute($update_stmt)) {
                                // Include WhatsApp sender
                                include 'send_whatsapp.php';
                                
                                // Send WhatsApp message
                                $whatsapp_result = sendWhatsAppMessage($data, $seat_number);
                                
                                // Success message
                                echo '<div class="mt-8 p-6 bg-[#025f92]/20 rounded-lg neon-border" data-aos="fade-up">';
                                echo '<p class="text-center text-xl mb-4 title-font neon-text">Pemesanan Berhasil!</p>';
                                
                                if ($whatsapp_result['success']) {
                                    echo '<p class="text-center mb-4">Kami telah mengirim detail pemesanan ke WhatsApp Anda.</p>';
                                } else {
                                    echo '<p class="text-center mb-4 text-yellow-400">Pemesanan berhasil tetapi gagal mengirim pesan WhatsApp.</p>';
                                    echo '<p class="text-center mb-4">Silakan hubungi admin di: 085640054840</p>';
                                }
                                
                                echo '<div class="bg-black/30 p-4 rounded-lg">';
                                echo '<p class="text-[#025f92] mb-2">Detail Pemesanan:</p>';
                                foreach ($data as $key => $value) {
                                    if ($key === 'jenis_kelamin') {
                                        $value = ($value === 'L') ? 'Laki-laki' : 'Perempuan';
                                    }
                                    echo '<p class="mb-1"><span class="text-gray-400">' . ucwords(str_replace('_', ' ', $key)) . ':</span> ' . $value . '</p>';
                                }
                                echo '<p class="mb-1"><span class="text-gray-400">Nomor Kursi:</span> ' . $seat_number . '</p>';
                                echo '</div></div>';
                            } else {
                                // Error updating jumlah_terpilih
                                echo '<div class="mt-8 p-6 bg-red-500/20 rounded-lg neon-border" data-aos="fade-up">';
                                echo '<p class="text-center text-xl mb-4 title-font neon-text">Warning!</p>';
                                echo '<p class="text-center mb-4">Pemesanan berhasil tapi gagal mengupdate jumlah terpilih.</p>';
                                echo '</div>';
                            }
                            mysqli_stmt_close($update_stmt);
                        } else {
                            // Error message
                            echo '<div class="mt-8 p-6 bg-red-500/20 rounded-lg neon-border" data-aos="fade-up">';
                            echo '<p class="text-center text-xl mb-4 title-font neon-text">Error!</p>';
                            echo '<p class="text-center mb-4">Terjadi kesalahan saat menyimpan data. Silakan coba lagi.</p>';
                            echo '</div>';
                        }
                        
                        mysqli_stmt_close($stmt);
                    }
                }
                ?>
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