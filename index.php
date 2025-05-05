<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AMERTA - Event Show Spectacular</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <style>
        /* Tambahkan style baru */
        .gradient-text {
            background: linear-gradient(45deg, #00b4d8, #90e0ef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.4;
        }

        .hover-glow {
            transition: all 0.3s ease;
        }

        .hover-glow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 180, 216, 0.3);
        }

        .gradient-border {
            border: 2px solid;
            border-image: linear-gradient(45deg, #00b4d8, #90e0ef);
            border-image-slice: 1;
        }

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

        @keyframes neonPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .neon-pulse {
            animation: neonPulse 2s infinite;
        }

        /* Hamburger menu styles */
        .hamburger {
            cursor: pointer;
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 24px;
            height: 18px;
        }

        .hamburger div {
            height: 3px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.active div:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active div:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active div:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            nav .nav-links {
                display: none;
                flex-direction: column;
                background: rgba(0, 23, 31, 0.95);
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                border-radius: 0 0 0 10px;
                box-shadow: 0 0 10px #025f92;
                z-index: 100;
            }

            nav .nav-links.active {
                display: flex;
            }

            nav .nav-links a {
                padding: 12px 20px;
                border-bottom: 1px solid #025f92;
            }
        }
    </style>
</head>

<body class="bg-[#00171f]">
    <!-- Sticky Navbar -->
    <nav class="fixed w-full z-50 bg-black/20 backdrop-blur-md py-4 shadow-lg transition-all duration-300 flex justify-between items-center px-6">
        <div class="title-font text-2xl neon-text">AMERTA</div>
        <div class="nav-links space-x-8 flex">
            <a href="#home" class="text-white hover:text-[#025f92] transition-colors">Home</a>
            <a href="#about" class="text-white hover:text-[#025f92] transition-colors">About</a>
            <a href="#events" class="text-white hover:text-[#025f92] transition-colors">Events</a>
            <a href="#tickets" class="text-white hover:text-[#025f92] transition-colors">Tickets</a>
            <a href="#faq" class="text-white hover:text-[#025f92] transition-colors">FAQ</a>
            <a href="#gallery" class="text-white hover:text-[#025f92] transition-colors">Gallery</a>
            <a href="#contact" class="text-white hover:text-[#025f92] transition-colors">Contact</a>
        </div>
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <video autoplay muted loop class="hero-video">
            <source src="https://player.vimeo.com/external/469830068.hd.mp4?s=3b1a4b8a2fbbf4f6bdcf2e9e0c3e4d5e5a8a3a3a&profile_id=175" type="video/mp4">
        </video>
        <div class="container mx-auto px-6 text-center relative z-10" data-aos="fade-up">
            <h1 class="title-font text-7xl md:text-8xl mb-6 gradient-text font-bold">
                AMERTA 2024
            </h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto text-gray-200">
                Enter a World of Light, Sound, and Unforgettable Moments
            </p>
            <button class="bg-gradient-to-r from-[#00b4d8] to-[#90e0ef] text-black px-8 py-4 rounded-full font-bold hover:opacity-90 transition-all duration-300 hover:scale-105">
                Get Your Tickets Now
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2" data-aos="fade-right">
                    <h2 class="text-4xl mb-6 font-bold gradient-text">The Ultimate Entertainment Experience</h2>
                    <p class="text-lg text-gray-300 mb-6">AMERTA 2024 redefines live entertainment with a fusion of cutting-edge technology and artistic mastery. Witness:</p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="p-6 bg-gradient-to-br from-[#00171f] to-[#003459] rounded-xl hover-glow">
                            <h3 class="text-2xl mb-3 text-[#00b4d8]">360° Holography</h3>
                            <p class="text-gray-400">Immersive 3D projections that surround the audience</p>
                        </div>
                        <div class="p-6 bg-gradient-to-br from-[#00171f] to-[#003459] rounded-xl hover-glow">
                            <h3 class="text-2xl mb-3 text-[#00b4d8]">Dolby Atmos Sound</h3>
                            <p class="text-gray-400">128-channel spatial audio experience</p>
                        </div>
                    </div>
                </div>
                <div class="relative h-96" data-aos="fade-left">
                    <img src="https://source.unsplash.com/800x1200/?concert,stage"
                        alt="Concert Stage"
                        class="w-full h-full object-cover rounded-xl gradient-border">
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="py-20 bg-[#1b425c]/30">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Event Categories</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-[#00171f] rounded-xl hover:neon-border transition-all" data-aos="flip-left">
                    <h3 class="text-2xl mb-4 title-font">Main Show</h3>
                    <p>The spectacular central performance featuring our headline artists</p>
                </div>
                <div class="p-6 bg-[#00171f] rounded-xl hover:neon-border transition-all" data-aos="flip-left" data-aos-delay="100">
                    <h3 class="text-2xl mb-4 title-font">Workshops</h3>
                    <p>Interactive sessions with artists and industry experts</p>
                </div>
                <div class="p-6 bg-[#00171f] rounded-xl hover:neon-border transition-all" data-aos="flip-left" data-aos-delay="200">
                    <h3 class="text-2xl mb-4 title-font">After Parties</h3>
                    <p>Exclusive celebrations with DJs and live music</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ticket Section -->
    <section id="tickets" class="py-20 bg-[#025f92]/10">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-2xl mx-auto" data-aos="zoom-in">
                <h2 class="title-font text-4xl mb-6 neon-text">Get Your Tickets Now</h2>
                <p class="mb-8">Secure your spot for the most anticipated event of the year. Various packages available to suit your needs.</p>
                <a href="./booking.php" class="bg-[#025f92] hover:bg-[#1b425c] text-white px-8 py-3 rounded-full transition-all duration-300 neon-border neon-pulse">
                    Buy Tickets
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-[#1b425c]/30">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Frequently Asked Questions</h2>
            <div class="space-y-6" data-aos="fade-up">
                <details class="bg-[#00171f] rounded-xl p-6 neon-border cursor-pointer">
                    <summary class="text-xl font-semibold cursor-pointer">What is AMERTA 2024?</summary>
                    <p class="mt-2 text-gray-300">AMERTA 2024 is a three-day spectacular event featuring world-class performances and cutting-edge technology.</p>
                </details>
                <details class="bg-[#00171f] rounded-xl p-6 neon-border cursor-pointer">
                    <summary class="text-xl font-semibold cursor-pointer">Where is the event located?</summary>
                    <p class="mt-2 text-gray-300">The event will be held at the AMERTA Grand Arena, a state-of-the-art venue with a 50,000 seating capacity.</p>
                </details>
                <details class="bg-[#00171f] rounded-xl p-6 neon-border cursor-pointer">
                    <summary class="text-xl font-semibold cursor-pointer">How can I purchase tickets?</summary>
                    <p class="mt-2 text-gray-300">Tickets can be purchased online through our website or at the venue box office.</p>
                </details>
                <details class="bg-[#00171f] rounded-xl p-6 neon-border cursor-pointer">
                    <summary class="text-xl font-semibold cursor-pointer">Are there any age restrictions?</summary>
                    <p class="mt-2 text-gray-300">The event is suitable for all ages, but some performances may have age restrictions.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-[#00171f]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl mb-12 text-center font-bold gradient-text">Immersive Moments</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <a href="https://source.unsplash.com/1600x900/?concert"
                    class="glightbox hover-glow">
                    <img src="https://source.unsplash.com/600x400/?concert,lights"
                        class="w-full h-48 object-cover rounded-lg transition-transform">
                </a>
                <a href="https://source.unsplash.com/1600x900/?concert"
                    class="glightbox hover-glow">
                    <img src="https://source.unsplash.com/600x400/?concert,lights"
                        class="w-full h-48 object-cover rounded-lg transition-transform">
                </a>
                <a href="https://source.unsplash.com/1600x900/?concert"
                    class="glightbox hover-glow">
                    <img src="https://source.unsplash.com/600x400/?concert,lights"
                        class="w-full h-48 object-cover rounded-lg transition-transform">
                </a>
                <a href="https://source.unsplash.com/1600x900/?concert"
                    class="glightbox hover-glow">
                    <img src="https://source.unsplash.com/600x400/?concert,lights"
                        class="w-full h-48 object-cover rounded-lg transition-transform">
                </a>
                <!-- Tambahkan lebih banyak gambar dengan pola yang sama -->
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-[#025f92]/10">
        <div class="container mx-auto px-6 max-w-3xl">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Contact Us</h2>
            <form class="space-y-6" data-aos="fade-up">
                <div>
                    <label for="name" class="block mb-2 font-semibold">Name</label>
                    <input type="text" id="name" name="name" required class="w-full rounded-full px-6 py-3 bg-black/30 border border-[#025f92] focus:outline-none focus:ring-2 focus:ring-[#025f92]" />
                </div>
                <div>
                    <label for="email" class="block mb-2 font-semibold">Email</label>
                    <input type="email" id="email" name="email" required class="w-full rounded-full px-6 py-3 bg-black/30 border border-[#025f92] focus:outline-none focus:ring-2 focus:ring-[#025f92]" />
                </div>
                <div>
                    <label for="message" class="block mb-2 font-semibold">Message</label>
                    <textarea id="message" name="message" rows="4" required class="w-full rounded-xl px-6 py-3 bg-black/30 border border-[#025f92] focus:outline-none focus:ring-2 focus:ring-[#025f92]"></textarea>
                </div>
                <button type="submit" class="bg-[#025f92] hover:bg-[#1b425c] text-white px-8 py-3 rounded-full transition-all duration-300 neon-border">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">What People Say</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-black/30 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-[#025f92] text-4xl mb-4">"</div>
                    <p class="mb-6">An absolutely mind-blowing experience! The visual effects were unlike anything I've ever seen before.</p>
                    <div class="flex items-center">
                        <img src="https://source.unsplash.com/random/100x100/?portrait" alt="Testimonial 1" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <p class="font-bold">Sarah Johnson</p>
                            <p class="text-sm text-gray-400">Music Enthusiast</p>
                        </div>
                    </div>
                </div>
                <div class="p-8 bg-black/30 rounded-xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-[#025f92] text-4xl mb-4">"</div>
                    <p class="mb-6">AMERTA sets a new standard for live entertainment. Every moment was pure magic!</p>
                    <div class="flex items-center">
                        <img src="https://source.unsplash.com/random/100x100/?man" alt="Testimonial 2" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <p class="font-bold">Michael Chen</p>
                            <p class="text-sm text-gray-400">Event Producer</p>
                        </div>
                    </div>
                </div>
                <div class="p-8 bg-black/30 rounded-xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-[#025f92] text-4xl mb-4">"</div>
                    <p class="mb-6">The perfect blend of technology and artistry. A must-see event of the year!</p>
                    <div class="flex items-center">
                        <img src="https://source.unsplash.com/random/100x100/?woman" alt="Testimonial 3" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <p class="font-bold">Emma Rodriguez</p>
                            <p class="text-sm text-gray-400">Art Director</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artist Lineup -->
    <section class="py-20 bg-[#1b425c]/30">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Featured Artists</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up">
                    <img src="https://source.unsplash.com/random/400x500/?singer" alt="Artist 1" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110" />
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Nova Aurora</h3>
                        <p class="text-gray-300">Headlining Performance</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://source.unsplash.com/random/400x500/?musician" alt="Artist 2" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110" />
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Pulse Collective</h3>
                        <p class="text-gray-300">Electronic Ensemble</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://source.unsplash.com/random/400x500/?band" alt="Artist 3" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110" />
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Stellar Dreams</h3>
                        <p class="text-gray-300">Visual Performance</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://source.unsplash.com/random/400x500/?performance" alt="Artist 4" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110" />
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Echo Rhythm</h3>
                        <p class="text-gray-300">Dance Ensemble</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Event Schedule</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-black/30 rounded-xl border border-[#025f92]" data-aos="fade-up">
                    <h3 class="title-font text-2xl mb-4 text-[#025f92]">Day 1</h3>
                    <ul class="space-y-4">
                        <li>
                            <span class="block text-lg font-semibold">Opening Ceremony</span>
                            <span class="text-gray-400">18:00 - 19:00</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Nova Aurora</span>
                            <span class="text-gray-400">19:30 - 21:00</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Pulse Collective</span>
                            <span class="text-gray-400">21:30 - 23:00</span>
                        </li>
                    </ul>
                </div>
                <div class="p-6 bg-black/30 rounded-xl border border-[#025f92]" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="title-font text-2xl mb-4 text-[#025f92]">Day 2</h3>
                    <ul class="space-y-4">
                        <li>
                            <span class="block text-lg font-semibold">Stellar Dreams</span>
                            <span class="text-gray-400">18:00 - 19:30</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Echo Rhythm</span>
                            <span class="text-gray-400">20:00 - 21:30</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Night Show</span>
                            <span class="text-gray-400">22:00 - 23:30</span>
                        </li>
                    </ul>
                </div>
                <div class="p-6 bg-black/30 rounded-xl border border-[#025f92]" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="title-font text-2xl mb-4 text-[#025f92]">Day 3</h3>
                    <ul class="space-y-4">
                        <li>
                            <span class="block text-lg font-semibold">Special Performance</span>
                            <span class="text-gray-400">18:00 - 19:30</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Grand Finale</span>
                            <span class="text-gray-400">20:00 - 22:00</span>
                        </li>
                        <li>
                            <span class="block text-lg font-semibold">Closing Ceremony</span>
                            <span class="text-gray-400">22:30 - 23:30</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Venue Section -->
    <section class="py-20 bg-[#025f92]/10">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Venue Information</h2>
            <div class="grid md:grid-cols-2 gap-12">
                <div class="rounded-xl overflow-hidden" data-aos="fade-right">
                    <img src="https://source.unsplash.com/800x600/?stadium" alt="Venue" class="w-full h-[400px] object-cover" />
                </div>
                <div class="flex flex-col justify-center" data-aos="fade-left">
                    <h3 class="title-font text-2xl mb-4">AMERTA Grand Arena</h3>
                    <p class="mb-6">Experience the spectacular in our state-of-the-art venue, featuring:</p>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-[#025f92] rounded-full mr-3"></span>
                            <span>50,000 seating capacity</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-[#025f92] rounded-full mr-3"></span>
                            <span>360-degree immersive screens</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-[#025f92] rounded-full mr-3"></span>
                            <span>Advanced sound system</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-2 h-2 bg-[#025f92] rounded-full mr-3"></span>
                            <span>Premium hospitality areas</span>
                        </li>
                    </ul>
                    <div class="mt-8">
                        <button class="bg-[#025f92] hover:bg-[#1b425c] text-white px-6 py-2 rounded-full transition-all duration-300 neon-border">
                            View Map
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="title-font text-4xl mb-6 neon-text" data-aos="zoom-in">Stay Updated</h2>
                <p class="mb-8">Subscribe to our newsletter for exclusive updates and special offers</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center" data-aos="fade-up">
                    <input type="email" placeholder="Enter your email" class="bg-black/30 border border-[#025f92] rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-[#025f92]" />
                    <button class="bg-[#025f92] hover:bg-[#1b425c] text-white px-8 py-3 rounded-full transition-all duration-300 neon-border">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors Section -->
    <section class="py-20 bg-black/30">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">Our Sponsors</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
                <div class="p-6" data-aos="fade-up">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+1" alt="Sponsor 1" class="w-full opacity-50 hover:opacity-100 transition-opacity" />
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+2" alt="Sponsor 2" class="w-full opacity-50 hover:opacity-100 transition-opacity" />
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+3" alt="Sponsor 3" class="w-full opacity-50 hover:opacity-100 transition-opacity" />
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+4" alt="Sponsor 4" class="w-full opacity-50 hover:opacity-100 transition-opacity" />
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/80 py-8">
        <div class="container mx-auto px-6 text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-400 hover:text-[#025f92] transition-colors" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.5 9.87v-6.98h-2.5v-2.9h2.5v-2.2c0-2.48 1.49-3.85 3.77-3.85 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.83h2.78l-.44 2.9h-2.34v6.98A10 10 0 0022 12z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-[#025f92] transition-colors" aria-label="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14.86 4.48 4.48 0 001.98-2.48 9.14 9.14 0 01-2.88 1.1 4.52 4.52 0 00-7.7 4.13A12.84 12.84 0 013 4.15a4.52 4.52 0 001.4 6.04 4.48 4.48 0 01-2.05-.57v.06a4.52 4.52 0 003.63 4.43 4.52 4.52 0 01-2.04.08 4.52 4.52 0 004.22 3.14A9.05 9.05 0 012 19.54a12.8 12.8 0 006.92 2.03c8.3 0 12.84-6.88 12.84-12.84 0-.2 0-.42-.02-.63A9.22 9.22 0 0023 3z" />
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-[#025f92] transition-colors" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zm8.75 1.5a1 1 0 110 2 1 1 0 010-2zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6z" />
                    </svg>
                </a>
            </div>
            <p class="text-gray-400">&copy; 2024 AMERTA. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        // Parallax Effect
        document.addEventListener('scroll', () => {
            const parallaxElements = document.querySelectorAll('[data-speed]');
            parallaxElements.forEach((element) => {
                const speed = parseFloat(element.dataset.speed);
                const y = window.pageYOffset * speed;
                element.style.transform = `translateY(${y}px)`;
            });
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

        // Hamburger menu toggle
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.querySelector('nav .nav-links');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    </script>
</body>

</html>