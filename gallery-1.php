<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Way to Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .gallery-title {
            text-align: center;
            margin: 40px 0 10px;
            font-weight: bold;
            font-size: 2rem;
            letter-spacing: 2px;
        }

        .gallery-subtitle {
            text-align: center;
            margin-bottom: 30px;
            color: #6c757d;
        }

        .img-card {
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .img-card:hover img {
            transform: scale(1.05);
        }

        .footer {
            background-color: #1f2e2e;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        /* Hero section styles */
        .hero-section {
            background: url('img/photo/1.webp') center center/cover no-repeat;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            margin-bottom: 40px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="mil-content">
        <div id="swupMain" class="mil-main-transition">

            <!-- Hero Section -->
            <section class="hero-section container">
            </section>

            <div class="container">

                <div class="row" id="gallery">
                    <!-- Gambar-gambar -->
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/1.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/2.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/3.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/4.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/5.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/6.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/7.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/8.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/9.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="img-card"><img src="img/works/10.webp" class="img-fluid" loading="lazy"></div>
                    </div>
                </div>

                <div class="text-center">
                    <button id="loadMoreBtn" class="btn btn-outline-primary my-5" onclick="loadMore()">Load More</button>
                </div>
            </div>

        </div>

    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let imageCount = 10;

        function loadMore() {
            const gallery = document.getElementById('gallery');
            for (let i = 0; i < 10; i++) {
                imageCount++;
                if (imageCount > 40) {
                    // Hide the Load More button if imageCount exceeds 40
                    document.getElementById('loadMoreBtn').style.display = 'none';
                    break;
                }
                const col = document.createElement('div');
                col.className = 'col-6 col-md-3';
                col.innerHTML = `
          <div class="img-card">
            <img src="img/works/${imageCount}.webp" class="img-fluid" loading="lazy">
          </div>`;
                gallery.appendChild(col);
            }
        }
    </script>

</body>

</html>