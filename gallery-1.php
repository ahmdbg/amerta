<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amerta | Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .gallery-title {
            text-align: center;
            margin: 50px 0 20px;
            font-weight: 600;
            font-size: 2.5rem;
            letter-spacing: 3px;
            color: #222;
        }

        .gallery-subtitle {
            text-align: center;
            margin-bottom: 40px;
            color: #555;
            font-weight: 300;
            font-size: 1.1rem;
        }

        .img-card {
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .img-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .img-card:hover img {
            transform: scale(1.1);
        }

        .footer {
            background-color: #1f2e2e;
            color: white;
            padding: 25px 0;
            text-align: center;
            margin-top: 60px;
            font-weight: 300;
            font-size: 0.9rem;
            letter-spacing: 1.5px;
        }

        .hero-section h1 {
            font-weight: 700;
            letter-spacing: 4px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        }

        .hero-section .btn {
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 30px;
            letter-spacing: 1.5px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark shadow-sm">
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
                        <a class="nav-link active" aria-current="page" href="gallery-1.php">Gallery</a>
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

    <!-- Hero Section -->
    <section class="hero-section text-center text-white d-flex align-items-center justify-content-center"
        style="height: 60vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/photo/2.webp') no-repeat center center/cover;">
        <div>
            <h1 class="display-4 fw-bold mb-3">Our Gallery</h1>
        </div>
    </section>

    <div class="container" style="margin-top: 60px;">

        <div class="row" id="gallery">
            <!-- Gambar-gambar -->
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/1.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/2.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/3.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/4.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/5.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/6.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/7.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/8.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/9.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="img-card"><img src="img/works/10.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;"></div>
            </div>
        </div>

        <!-- Modal for lightbox -->
        <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body p-0">
                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <img src="" id="lightboxImage" class="img-fluid rounded" alt="Lightbox Image" style="width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-outline-primary mt-3" onclick="loadMore()">Load More</button>
        </div>
    </div>

    <div class="footer">
        © Copyright 2023 - Amerta. Bangkitkan Gelora Nusantara. All Rights Reserved.
    </div>

    <script>
        let imageCount = 10;

        function loadMore() {
            const gallery = document.getElementById('gallery');
            for (let i = 0; i < 10; i++) {
                imageCount++;
                const col = document.createElement('div');
                col.className = 'col-6 col-md-3';
                col.innerHTML = `
          <div class="img-card">
            <img src="img/works/${imageCount}.webp" class="img-fluid gallery-image" loading="lazy" style="cursor:pointer;">
          </div>`;
                gallery.appendChild(col);
            }
            if (imageCount >= 40) {
                const loadMoreBtn = document.querySelector('.btn.btn-outline-primary');
                if (loadMoreBtn) {
                    loadMoreBtn.style.display = 'none';
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>