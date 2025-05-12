<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- bootstrap grid css -->
    <link rel="stylesheet" href="css/plugins/bootstrap-grid.css" />
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/plugins/font-awesome.min.css" />
    <!-- swiper css -->
    <link rel="stylesheet" href="css/plugins/swiper.min.css" />
    <!-- fancybox css -->
    <link rel="stylesheet" href="css/plugins/fancybox.min.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #343a40;
        }

        .gallery-title {
            text-align: center;
            margin: 50px 0 15px;
            font-weight: 700;
            font-size: 2.75rem;
            letter-spacing: 3px;
            color: #212529;
            text-transform: uppercase;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .gallery-subtitle {
            text-align: center;
            margin-bottom: 40px;
            color: #6c757d;
            font-size: 1.1rem;
            font-style: italic;
        }

        .img-card {
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            cursor: pointer;
            background-color: #fff;
        }

        .img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            border-radius: 15px;
            display: block;
        }

        .img-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .img-card:hover img {
            transform: scale(1.1);
        }

        .btn-load-more {
            border-radius: 50px;
            padding: 12px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-load-more:hover {
            background-color: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }

        /* Fade-in animation for new images */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }
    </style>

    <title>Amerta | Performance</title>
</head>

<body>
    <div class="mil-wrapper" id="top">

        <!-- cursor -->
        <div class="mil-ball">
            <span class="mil-icon-1">
                <svg viewBox="0 0 128 128">
                    <path d="M106.1,41.9c-1.2-1.2-3.1-1.2-4.2,0c-1.2,1.2-1.2,3.1,0,4.2L116.8,61H11.2l14.9-14.9c1.2-1.2,1.2-3.1,0-4.2	c-1.2-1.2-3.1-1.2-4.2,0l-20,20c-1.2,1.2-1.2,3.1,0,4.2l20,20c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9c1.2-1.2,1.2-3.1,0-4.2	L11.2,67h105.5l-14.9,14.9c-1.2,1.2-1.2,3.1,0,4.2c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9l20-20c1.2-1.2,1.2-3.1,0-4.2	L106.1,41.9	z" />
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


        <?php include 'components/menu.php'; ?>
        <!-- curtain -->
        <div class="mil-curtain"></div>
        <!-- curtain end -->

        <!-- content -->
        <div class="mil-content">
            <div id="swupMain" class="mil-main-transition">
                <!-- banner -->
                <div class="mil-inner-banner">
                    <div class="mil-banner-content mil-up">
                        <div class="mil-animation-frame">
                            <div class="mil-animation mil-position-4 mil-dark mil-scale" data-value-1="6" data-value-2="1.4"></div>
                        </div>
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-mb-60">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="#.">Gallery</a></li>
                            </ul>
                            <h1 class="mil-mb-60 gallery-title">Our <span class="mil-thin">Gallery</span></h1>
                            <p class="gallery-subtitle">Explore our collection of beautiful images</p>
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <div class="container">
                    <div class="row" id="gallery">
                        <!-- Gambar-gambar -->
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/1.webp" data-fancybox="gallery" data-caption="Gallery Image 1">
                                    <img src="img/works/1.webp" class="img-fluid" loading="lazy" alt="Gallery Image 1" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/2.webp" data-fancybox="gallery" data-caption="Gallery Image 2">
                                    <img src="img/works/2.webp" class="img-fluid" loading="lazy" alt="Gallery Image 2" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/3.webp" data-fancybox="gallery" data-caption="Gallery Image 3">
                                    <img src="img/works/3.webp" class="img-fluid" loading="lazy" alt="Gallery Image 3" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/4.webp" data-fancybox="gallery" data-caption="Gallery Image 4">
                                    <img src="img/works/4.webp" class="img-fluid" loading="lazy" alt="Gallery Image 4" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/5.webp" data-fancybox="gallery" data-caption="Gallery Image 5">
                                    <img src="img/works/5.webp" class="img-fluid" loading="lazy" alt="Gallery Image 5" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/6.webp" data-fancybox="gallery" data-caption="Gallery Image 6">
                                    <img src="img/works/6.webp" class="img-fluid" loading="lazy" alt="Gallery Image 6" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/7.webp" data-fancybox="gallery" data-caption="Gallery Image 7">
                                    <img src="img/works/7.webp" class="img-fluid" loading="lazy" alt="Gallery Image 7" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/8.webp" data-fancybox="gallery" data-caption="Gallery Image 8">
                                    <img src="img/works/8.webp" class="img-fluid" loading="lazy" alt="Gallery Image 8" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/9.webp" data-fancybox="gallery" data-caption="Gallery Image 9">
                                    <img src="img/works/9.webp" class="img-fluid" loading="lazy" alt="Gallery Image 9" />
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="img-card">
                                <a href="img/works/10.webp" data-fancybox="gallery" data-caption="Gallery Image 10">
                                    <img src="img/works/10.webp" class="img-fluid" loading="lazy" alt="Gallery Image 10" />
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="loadMoreBtn" class="btn btn-outline-primary my-3 btn-load-more" onclick="loadMore()">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery js -->
    <script src="js/plugins/jquery.min.js"></script>
    <!-- swup js -->
    <script src="js/plugins/swup.min.js"></script>
    <!-- swiper js -->
    <script src="js/plugins/swiper.min.js"></script>
    <!-- fancybox js -->
    <script src="js/plugins/fancybox.min.js"></script>
    <!-- main js -->
    <script src="js/main.js"></script>

    <script>
        let imageCount = 10;
        const maxImages = 40;

        function checkLoadMoreButton() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (imageCount >= maxImages) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'inline-block';
            }
        }

        function loadMore() {
            const gallery = document.getElementById('gallery');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            for (let i = 0; i < 10; i++) {
                imageCount++;
                if (imageCount > maxImages) {
                    loadMoreBtn.style.display = 'none';
                    break;
                }
                const col = document.createElement('div');
                col.className = 'col-6 col-md-3 fade-in-up';
                col.innerHTML = `
          <div class="img-card">
            <a href="img/works/${imageCount}.webp" data-fancybox="gallery" data-caption="Gallery Image ${imageCount}">
              <img src="img/works/${imageCount}.webp" class="img-fluid" loading="lazy" alt="Gallery Image ${imageCount}">
            </a>
          </div>`;
                gallery.appendChild(col);
            }
            checkLoadMoreButton();
        }

        // Check button visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            checkLoadMoreButton();
        });
    </script>
</body>

</html>
