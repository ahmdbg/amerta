<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Amerta | Performance</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        /* Custom styles for spacing and text */
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }

        .performance-title {
            font-weight: 300;
        }

        .performance-subtitle {
            font-weight: 700;
            color: #0d6efd;
        }

        .performance-description {
            text-align: justify;
            font-size: 1.05rem;
            line-height: 1.6;
            color: #495057;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        .btn-buy-ticket {
            font-weight: 600;
            padding: 0.75rem 1.5rem;
        }

        .section-cta {
            background-color: #f8f9fa;
            padding: 4rem 0;
            text-align: center;
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(13, 110, 253, 0.2);
        }

        /* Navbar improvements */
        .navbar {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-size: 1.75rem;
            letter-spacing: 2px;
            color: #fff !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #e9ecef !important;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 0.375rem;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler-icon {
            filter: drop-shadow(0 0 1px rgba(255, 255, 255, 0.7));
        }

        /* Performance card style */
        .performance-card {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .performance-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .performance-image {
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Amerta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery-1.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="program-detail.php">Show</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="team.php">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <!-- Page Title -->
        <header class="mb-5 text-center">
            <h1 class="display-4">Performance <span class="fw-light">Acara</span></h1>
        </header>

        <!-- Performances List -->
        <section>
            <?php
            $performances = [
                [
                    "title" => "Medley Tari Tradisional",
                    "subtitle" => "",
                    "image" => "img/performance/image-1.webp",
                    "alt" => "Medley Tari Tradisional",
                    "description" => "Medley Tari Tradisional menampilkan berbagai tarian khas dari berbagai daerah di Indonesia, memperlihatkan keindahan dan keberagaman budaya Nusantara."
                ],
                [
                    "title" => "Pantomim",
                    "subtitle" => "",
                    "image" => "img/performance/image-2.webp",
                    "alt" => "Pantomim",
                    "description" => "Seni pertunjukan tanpa kata yang mengandalkan ekspresi wajah dan gerak tubuh untuk menyampaikan cerita, pesan, atau emosi secara kuat dan imajinatif."
                ],
                [
                    "title" => "Drama dan Teater",
                    "subtitle" => "",
                    "image" => "img/performance/image-3.webp",
                    "alt" => "Drama dan Teater",
                    "description" => "Seni pertunjukan yang menampilkan konflik, karakter, dan alur cerita melalui akting ekspresif, tata panggung, serta dialog hidup yang mengajak penonton meresapi pesan moralnya."
                ],
                [
                    "title" => "Tari Perang",
                    "subtitle" => "",
                    "image" => "img/performance/image-4.webp",
                    "alt" => "Tari Perang",
                    "description" => "Tarian tradisional penuh semangat yang menampilkan simulasi peperangan, simbol keberanian, dan kesiapan para pejuang dalam mempertahankan kehormatan serta wilayah suku mereka."
                ],
                [
                    "title" => "Vairasi PBB",
                    "subtitle" => "",
                    "image" => "img/performance/image-5.webp",
                    "alt" => "Vairasi PBB",
                    "description" => "Kreasi baris-berbaris inovatif yang memadukan disiplin, kekompakan, serta gerakan dinamis untuk menunjukkan semangat juang dan kebersamaan dalam formasi yang menarik."
                ],
                [
                    "title" => "Syarhil",
                    "subtitle" => "",
                    "image" => "img/performance/image-6.webp",
                    "alt" => "Syarhil",
                    "description" => "Pertunjukan dakwah berbentuk tim yang memadukan tilawah, sari tilawah, dan ceramah untuk menyampaikan pesan moral dan keislaman secara menarik dan menyentuh."
                ],
                [
                    "title" => "Tari Randai",
                    "subtitle" => "",
                    "image" => "img/performance/image-7.webp",
                    "alt" => "Tari Randai",
                    "description" => "Pertunjukan tradisional Minangkabau yang menggabungkan tarian, drama, dan silat, menampilkan cerita rakyat dengan iringan musik dan dialog khas dalam lingkaran gerak yang dinamis."
                ],
                [
                    "title" => "Tari Pabat Pibui",
                    "subtitle" => "",
                    "image" => "img/performance/image-8.webp",
                    "alt" => "Tari Pabat Pibui",
                    "description" => "Tari khas yang mencerminkan nilai-nilai adat dan kehidupan masyarakat melalui gerakan ritmis, busana unik, serta simbol-simbol budaya daerah yang sarat makna dan pesan sosial."
                ],
                [
                    "title" => "Beauty of Java",
                    "subtitle" => "",
                    "image" => "img/performance/image-9.webp",
                    "alt" => "Beauty of Java",
                    "description" => "Tari klasik yang menggambarkan keanggunan budaya Jawa melalui gerakan halus, busana tradisional, dan musik gamelan yang mencerminkan kelembutan serta keindahan batin."
                ],
                [
                    "title" => "Tari Pakarena.Organza",
                    "subtitle" => "",
                    "image" => "img/performance/image-10.webp",
                    "alt" => "Tari Pakarena.Organza",
                    "description" => "Tarian klasik khas Sulawesi Selatan yang memadukan kelembutan gerak Tari Pakarena dengan sentuhan modern melalui kostum organza, menciptakan nuansa anggun, elegan, dan memikat."
                ],
                [
                    "title" => "Spirit of Papua",
                    "subtitle" => "",
                    "image" => "img/performance/image-11.webp",
                    "alt" => "Spirit of Papua",
                    "description" => "Pertunjukan energik yang menggambarkan semangat, keberanian, dan kekayaan budaya Papua melalui gerakan dinamis, kostum khas, serta irama musik tradisional yang membangkitkan jiwa."
                ],
                [
                    "title" => "Drama Musikal",
                    "subtitle" => "",
                    "image" => "img/performance/image-12.webp",
                    "alt" => "Drama Musikal",
                    "description" => "Pertunjukan panggung yang memadukan akting, lagu, dan musik secara harmonis untuk menyampaikan cerita penuh emosi, menjadikan setiap adegan hidup dan menggugah perasaan penonton."
                ],
            ];
            $performanceNumber = 1;
            foreach ($performances as $performance) {
                echo '<div class="row mb-5 align-items-center performance-card p-3">';
                echo '<div class="col-lg-6">';
                echo '<img src="' . $performance["image"] . '" alt="' . $performance["alt"] . '" class="img-fluid performance-image mb-3" />';
                echo '</div>';
                echo '<div class="col-lg-6">';
                echo '<h5 class="text-muted">Performance ' . $performanceNumber . '</h5>';
                echo '<h2 class="performance-subtitle">' . $performance["title"] . '</h2>';
                if (!empty($performance["subtitle"])) {
                    echo '<h4 class="performance-title">' . $performance["subtitle"] . '</h4>';
                }
                echo '<p class="performance-description">' . $performance["description"] . '</p>';
                echo '</div>';
                echo '</div>';
                $performanceNumber++;
            }
            ?>
        </section>

        <!-- Call to Action -->
        <section class="section-cta mt-5">
            <span class="text-uppercase text-secondary fw-semibold mb-3 d-block">Jangan lewatkan malam spektakuler ini</span>
            <h2 class="mb-4">Siap menyaksikan <span class="fw-light">keajaiban</span> <br />budaya <span class="fw-light">Nusantara?</span></h2>
            <a href="booking.php" class="btn btn-primary btn-buy-ticket">
                Beli Tiket Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-2">&copy; 2024 Amerta. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS CDN (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
