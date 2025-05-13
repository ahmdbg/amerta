<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/ashley-demo/team.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 May 2025 10:05:52 GMT -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- bootstrap grid css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/plugins/font-awesome.min.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="css/plugins/swiper.min.css">
    <!-- fancybox css -->
    <link rel="stylesheet" href="css/plugins/fancybox.min.css">
    <!-- ashley scss -->
    <link rel="stylesheet" href="css/style.css">
    <!-- page name -->
    <title>Amerta | Team</title>

    <style>
        /* Card style for images inside mil-reviews-slider */
        .mil-reviews-slider .swiper-slide {
            /* Remove grid layout from swiper-slide to avoid conflict with Swiper.js */
            display: block !important;
            padding: 10px 0;
        }

        .mil-reviews-slider .mil-review-frame {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 0 15px;
        }

        .mil-reviews-slider .team-card {
            background: #1e1e2f;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 240px;
            text-align: center;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease;
            margin: 0 auto;
        }

        .mil-reviews-slider .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
        }

        .mil-reviews-slider .team-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #f47c3c;
        }

        .mil-reviews-slider .team-card .name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .mil-reviews-slider .team-card .role {
            font-size: 0.9rem;
            color: #f47c3c;
            margin-bottom: 10px;
        }

        .mil-reviews-slider .team-card .about {
            font-size: 0.85rem;
            color: #ccc;
            margin-bottom: 15px;
            min-height: 50px;
        }

        .mil-reviews-slider .team-card button {
            background: #f47c3c;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .mil-reviews-slider .team-card button:hover {
            background: #d96a2a;
        }

        @media (max-width: 992px) {
            .mil-reviews-slider .mil-review-frame {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
                padding: 0 10px;
            }

            .mil-reviews-slider .team-card {
                width: 200px;
                padding: 18px;
            }

            .mil-reviews-slider .team-card img {
                width: 90px;
                height: 90px;
                margin-bottom: 12px;
            }

            .mil-reviews-slider .team-card .name {
                font-size: 1rem;
                margin-bottom: 8px;
            }

            .mil-reviews-slider .team-card .role {
                font-size: 0.85rem;
            }

            .mil-reviews-slider .team-card .about {
                font-size: 0.8rem;
                min-height: 45px;
            }
        }

        @media (max-width: 768px) {
            .mil-reviews-slider .mil-review-frame {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                padding: 0 5px;
            }

            .mil-reviews-slider .team-card {
                width: 180px;
                padding: 15px;
            }

            .mil-reviews-slider .team-card img {
                width: 80px;
                height: 80px;
                margin-bottom: 10px;
            }

            .mil-reviews-slider .team-card .name {
                font-size: 1rem;
                margin-bottom: 8px;
            }

            .mil-reviews-slider .team-card .role {
                font-size: 0.8rem;
            }

            .mil-reviews-slider .team-card .about {
                font-size: 0.75rem;
                min-height: 40px;
            }
        }
</style>

<style>
    /* Fix swiper navigation arrows position */
    .mil-slider-arrow {
        top: 50% !important;
        transform: translateY(-50%);
        width: 35px;
        height: 35px;
        background: rgba(244, 124, 60, 0.8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.3s ease;
    }

    .mil-slider-arrow:hover {
        background: rgba(217, 106, 42, 0.9);
    }

    .mil-prev {
        left: 10px !important;
    }

    .mil-revi-next {
        right: 10px !important;
    }

    /* Fix menu active link style */
    .mil-main-menu .mil-active > a {
        color: #f47c3c !important;
        font-weight: 700;
    }

    /* Fix footer menu active link style */
    footer .mil-footer-menu .mil-active > a {
        color: #f47c3c !important;
        font-weight: 700;
    }
</style>
</head>

<body>

    <!-- wrapper -->
    <div class="mil-wrapper" id="top">

        <!-- cursor -->
        <div class="mil-ball">
            <span class="mil-icon-1">
                <svg viewBox="0 0 128 128">
                    <path d="M106.1,41.9c-1.2-1.2-3.1-1.2-4.2,0c-1.2,1.2-1.2,3.1,0,4.2L116.8,61H11.2l14.9-14.9c1.2-1.2,1.2-3.1,0-4.2	c-1.2-1.2-3.1-1.2-4.2,0l-20,20c-1.2,1.2-1.2,3.1,0,4.2l20,20c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9c1.2-1.2,1.2-3.1,0-4.2	L11.2,67h105.5l-14.9,14.9c-1.2,1.2-1.2,3.1,0,4.2c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9l20-20c1.2-1.2,1.2-3.1,0-4.2L106.1,41.9	z" />
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

        <div class="mil-menu-frame">
            <!-- frame clone -->
            <div class="mil-frame-top">
                <a href="index.php" class="mil-logo" style="color: #f47c3c;">Amerta.</a>
                <div class="mil-menu-btn">
                    <span></span>
                </div>
            </div>
            <!-- frame clone end -->
            <div class="container">
                <div class="mil-menu-content">
                    <div class="row">
                        <div class="col-xl-5">

                            <nav class="mil-main-menu" id="swupMenu">
                                <ul>
                                    <li class="mil-has-children">
                                        <a href="./index.php">Home</a>
                                    </li>
                                    <li class="mil-has-children mil-active">
                                        <a href="./team.php">Team</a>
                                    </li>
                                    <li class="mil-has-children">
                                        <a href="./gallery-1.php">Gallery</a>
                                    </li>
                                    <li class="mil-has-children">
                                        <a href="./contact.php">Contact</a>
                                    </li>
                                    <li class="mil-has-children">
                                        <a href="./store.php">Store</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                        <div class="col-xl-7">

                            <div class="mil-menu-right-frame">
                                <div class="mil-animation-in">
                                    <div class="mil-animation-frame">
                                        <div class="mil-animation mil-position-1 mil-scale" data-value-1="2" data-value-2="2"></div>
                                    </div>
                                </div>
                                <div class="mil-menu-right">
                                    <div class="row">
                                        <div class="col-lg-8 mil-mb-60">

                                            <h6 class="mil-muted mil-mb-30">Projects</h6>

                                            <ul class="mil-menu-list">
                                                <li><a href="project-1.php" class="mil-light-soft">Interior design studio</a></li>
                                                <li><a href="project-2.php" class="mil-light-soft">Home Security Camera</a></li>
                                                <li><a href="project-3.php" class="mil-light-soft">Kemia Honest Skincare</a></li>
                                                <li><a href="project-4.php" class="mil-light-soft">Cascade of Lava</a></li>
                                                <li><a href="project-5.php" class="mil-light-soft">Air Pro by Molekule</a></li>
                                                <li><a href="project-6.php" class="mil-light-soft">Tony's Chocolonely</a></li>
                                            </ul>

                                        </div>
                                        <div class="col-lg-4 mil-mb-60">

                                            <h6 class="mil-muted mil-mb-30">Useful links</h6>

                                            <ul class="mil-menu-list">
                                                <li><a href="#." class="mil-light-soft">Privacy Policy</a></li>
                                                <li><a href="#." class="mil-light-soft">Terms and conditions</a></li>
                                                <li><a href="#." class="mil-light-soft">Cookie Policy</a></li>
                                                <li><a href="#." class="mil-light-soft">Careers</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="mil-divider mil-mb-60"></div>
                                    <div class="row justify-content-between">

                                        <div class="col-lg-4 mil-mb-60">

                                            <h6 class="mil-muted mil-mb-30">Canada</h6>

                                            <p class="mil-light-soft mil-up">71 South Los Carneros Road, California <span class="mil-no-wrap">+51 174 705 812</span></p>

                                        </div>
                                        <div class="col-lg-4 mil-mb-60">

                                            <h6 class="mil-muted mil-mb-30">Germany</h6>

                                            <p class="mil-light-soft">Leehove 40, 2678 MC De Lier, Netherlands <span class="mil-no-wrap">+31 174 705 811</span></p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- curtain -->
        <div class="mil-curtain"></div>
        <!-- curtain end -->

        <!-- frame -->
        <?php include "components/frame.php"; ?>
        <!-- frame end -->

        <!-- content -->
        <div class="mil-content">
            <div id="swupMain" class="mil-main-transition">


                <!-- reviews -->
                <section class="mil-soft-bg">
                    <div class="container mil-p-120-120">


                        <h2 class="mil-center mil-up mil-mb-60">Our <span class="mil-thin">Team</span></h2>

                        <div class="mil-revi-pagination mil-up mil-mb-60"></div>

                        <div class="row mil-relative justify-content-center">
                            <div class="col-lg-8">

                                <div class="mil-slider-nav mil-soft mil-reviews-nav mil-up">
                                    <div class="mil-slider-arrow mil-prev mil-revi-prev mil-arrow-place"></div>
                                    <div class="mil-slider-arrow mil-revi-next mil-arrow-place"></div>
                                </div>

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="mil-quote-icon mil-up">
                                    <path d="M 13.5 10 A 8.5 8.5 0 0 0 13.5 27 A 8.5 8.5 0 0 0 18.291016 25.519531 C 17.422273 29.222843 15.877848 31.803343 14.357422 33.589844 C 12.068414 36.279429 9.9433594 37.107422 9.9433594 37.107422 A 1.50015 1.50015 0 1 0 11.056641 39.892578 C 11.056641 39.892578 13.931586 38.720571 16.642578 35.535156 C 19.35357 32.349741 22 27.072581 22 19 A 1.50015 1.50015 0 0 0 21.984375 18.78125 A 8.5 8.5 0 0 0 13.5 10 z M 34.5 10 A 8.5 8.5 0 0 0 34.5 27 A 8.5 8.5 0 0 0 39.291016 25.519531 C 38.422273 29.222843 36.877848 31.803343 35.357422 33.589844 C 33.068414 36.279429 30.943359 37.107422 30.943359 37.107422 A 1.50015 1.50015 0 1 0 32.056641 39.892578 C 32.056641 39.892578 34.931586 38.720571 37.642578 35.535156 C 40.35357 32.349741 43 27.072581 43 19 A 1.50015 1.50015 0 0 0 42.984375 18.78125 A 8.5 8.5 0 0 0 34.5 10 z" fill="#000000" />
                                </svg>

                                <div class="swiper-container mil-reviews-slider">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Naufal Rasyad Ayyasy</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Aqil Dhiya Ulhaq</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Rafi' Ahnaf Dzikri Haq</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Faiz Hibaturrahman</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Fathy Farahat Akbar</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Naufal Fikri Maulana</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Rizqy Ramadhani</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ramadhan Miftahfarid Wiraputra</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Nabil Rayendra</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Shatara Enzi Artriano</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Rafa Adha Yudhayana</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Fardan Alfathon</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Abdullah Fawwaaz</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Hafidz Nashrullah </div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Naufal Arfa Danishwira</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Makin Amin Yusufa</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Yahya Ayyasy</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Afraldo Julian Putra Kristiawan</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Bawazir Arrafat</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Husain Hafidz</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Daffa Maulana Fernanda</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">
                                                        <div class="name">Farrel Kusuma Putra</div>
                                                    </div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ahmad Hasan</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Izzudin El Mizwary</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Daud Yusuf Nashrullah</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Fadlil Nurushodiq A</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ahmad Fathin Firdaus</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Haidar Dhiaulhaq</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Asyraf Wiratama S P</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Hauzan Azmil Umur</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Hamas Muhammad Fatahillah</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Faris Alfatih</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Ilham Rafi Alhaqqi</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Haidar Navid Zee Zakri</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Tsany Muhammad Falih</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Nashril Attila Rusly</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Mumtaz Taufiqul</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Fahry Irawan</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ahsana Hafidz Prawiratama</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ubayyu Bachrunniam</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Salman Zufar</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Lintas Adzan Muhammad</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Aqila Ayyasy Zakri</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Akyas Nizarurrohman</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Aulia Jundi Azizi</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Faqih Aziz</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Rosyad Muzaffar</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Alif Amtsal Absali</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Maulana Mahmud Abbas Alhabsyi</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Wazif Istibra</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="mil-review-frame mil-center" data-swiper-parallax="-200" data-swiper-parallax-opacity="0">
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Moh Fadey Alvaro</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Haidar Jundi</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Rafif Muzhofar</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Muhammad Yaqut Al-Asadi</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Hudzaifah Al Hakim</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ghozi Ahmad Mubarok</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Thaariq Muhammad Kamil</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Qisiyyuna Hauna Quddama</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Maulida Al Ghifari</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Maftuh Faqih Arifin</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/1.jpg" alt="Team member">
                                                    <div class="name">Abdul Halim Arrasyid</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">El Hallaj Vaincenna Alfansyah</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Ananda Aditya Ramadhan</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Salman Fatih Al-Farouq</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                                <div class="team-card">
                                                    <img src="img/faces/2.jpg" alt="Team member">
                                                    <div class="name">Muhammad Ghozi Almubarok</div>
                                                    <button><i class="fab fa-instagram"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
                <!-- reviews end -->

                <!-- call to action -->
                <section class="mil-soft-bg">
                    <div class="container mil-p-120-120">
                        <div class="row">
                            <div class="col-lg-10">

                                <span class="mil-suptitle mil-suptitle-right mil-suptitle-dark mil-up">Looking to make your mark? We'll help you turn <br> your project into a success story.</span>

                            </div>
                        </div>
                        <div class="mil-center">
                            <h2 class="mil-up mil-mb-60">Ready to bring your <span class="mil-thin">ideas to</span> life? <br> We're <span class="mil-thin">here to help</span></h2>
                            <div class="mil-up"><a href="contact.php" class="mil-button mil-arrow-place"><span>Contact us</span></a></div>
                        </div>
                    </div>
                </section>
                <!-- call to action end -->

                <!-- footer -->
                <footer class="mil-dark-bg">
                    <div class="mi-invert-fix">
                        <div class="container mil-p-120-60">
                            <div class="row justify-content-between">
                                <div class="col-md-4 col-lg-4 mil-mb-60">

                                    <div class="mil-muted mil-logo mil-up mil-mb-30">Amerta.</div>

                                    <p class="mil-light-soft mil-up mil-mb-30">Subscribe our newsletter:</p>

                                    <form class="mil-subscribe-form mil-up">
                                        <input type="text" placeholder="Enter our email">
                                        <button type="submit" class="mil-button mil-icon-button-sm mil-arrow-place"></button>
                                    </form>

                                </div>
                                <div class="col-md-7 col-lg-6">
                                    <div class="row justify-content-end">
                                        <div class="col-md-6 col-lg-7">

                                            <nav class="mil-footer-menu mil-mb-60">
                                                <ul>
                                                    <li class="mil-up">
                                                        <a href="index.php">Home</a>
                                                    </li>
                                                    <li class="mil-up">
                                                        <a href="team.php mil-active">Team</a>
                                                    </li>
                                                    <li class="mil-up">
                                                        <a href="gallery-1.php">Gallery</a>
                                                    </li>
                                                    <li class="mil-up">
                                                        <a href="contact.php">Contact</a>
                                                    </li>
                                                    <li class="mil-up">
                                                        <a href="store.php">Store</a>
                                                    </li>
                                                </ul>
                                            </nav>

                                        </div>
                                        <div class="col-md-6 col-lg-5">

                                            <ul class="mil-menu-list mil-up mil-mb-60">
                                                <li><a href="#." class="mil-light-soft">Privacy Policy</a></li>
                                                <li><a href="#." class="mil-light-soft">Terms and conditions</a></li>
                                                <li><a href="#." class="mil-light-soft">Cookie Policy</a></li>
                                                <li><a href="#." class="mil-light-soft">Careers</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between flex-sm-row-reverse">
                                <div class="col-md-7 col-lg-6">

                                    <div class="row justify-content-between">

                                        <div class="col-md-6 col-lg-5 mil-mb-60">

                                            <h6 class="mil-muted mil-up mil-mb-30">Canada</h6>

                                            <p class="mil-light-soft mil-up">71 South Los Carneros Road, California <span class="mil-no-wrap">+51 174 705 812</span></p>

                                        </div>
                                        <div class="col-md-6 col-lg-5 mil-mb-60">

                                            <h6 class="mil-muted mil-up mil-mb-30">Germany</h6>

                                            <p class="mil-light-soft mil-up">Leehove 40, 2678 MC De Lier, Netherlands <span class="mil-no-wrap">+31 174 705 811</span></p>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-lg-6 mil-mb-60">

                                    <div class="mil-vert-between">
                                        <div class="mil-mb-30">
                                            <ul class="mil-social-icons mil-up">
                                                <li><a href="#." target="_blank" class="social-icon"> <i class="fab fa-behance"></i></a></li>
                                                <li><a href="#." target="_blank" class="social-icon"> <i class="fab fa-dribbble"></i></a></li>
                                                <li><a href="#." target="_blank" class="social-icon"> <i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#." target="_blank" class="social-icon"> <i class="fab fa-github"></i></a></li>
                                            </ul>
                                        </div>
                                        <p class="mil-light-soft mil-up">© Copyright 2023 - Mil. All Rights Reserved.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </footer> <!-- footer end -->

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

</body>


<!-- Mirrored from miller.bslthemes.com/ashley-demo/team.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 May 2025 10:05:53 GMT -->

</html>