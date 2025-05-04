<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMERTA - Event Show Spectacular</title>
    
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
            <div class="title-font text-2xl neon-text">AMERTA</div>
            <div class="space-x-8">
                <a href="#home" class="text-white hover:text-[#025f92] transition-colors">Home</a>
                <a href="#about" class="text-white hover:text-[#025f92] transition-colors">About</a>
                <a href="#events" class="text-white hover:text-[#025f92] transition-colors">Events</a>
                <a href="#tickets" class="text-white hover:text-[#025f92] transition-colors">Tickets</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center parallax-bg" style="background-image: linear-gradient(rgba(0,23,31,0.9), rgba(0,23,31,0.9)), url('https://source.unsplash.com/random/1920x1080/?concert');">
        <div class="container mx-auto px-6 text-center" data-aos="fade-up">
            <h1 class="title-font text-6xl mb-6 neon-text neon-pulse">AMERTA 2024</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Experience the most spectacular show of the decade featuring world-class performers and breathtaking production</p>
            <button class="bg-[#025f92] hover:bg-[#1b425c] text-white px-8 py-3 rounded-full transition-all duration-300 neon-border">
                Book Now
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="title-font text-4xl mb-6 neon-text">About The Event</h2>
                    <p class="mb-4">AMERTA is a revolutionary entertainment experience combining cutting-edge technology, stunning visual effects, and world-class performances.</p>
                    <p>Featuring over 100 artists from 20 different countries, this 3-day extravaganza will transform your perception of live entertainment.</p>
                </div>
                <div class="relative h-96" data-aos="fade-left">
                    <div class="absolute inset-0 bg-[#1b425c] rounded-xl" data-speed="0.2"></div>
                    <img src="https://source.unsplash.com/random/800x600/?stage" alt="About" class="absolute inset-0 w-full h-full object-cover rounded-xl transform translate-x-6 translate-y-6 border-2 border-[#025f92]">
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
                <!-- Add more event cards -->
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

    <!-- Testimonial Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="title-font text-4xl mb-12 text-center neon-text" data-aos="zoom-in">What People Say</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-black/30 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-[#025f92] text-4xl mb-4">"</div>
                    <p class="mb-6">An absolutely mind-blowing experience! The visual effects were unlike anything I've ever seen before.</p>
                    <div class="flex items-center">
                        <img src="https://source.unsplash.com/random/100x100/?portrait" alt="Testimonial 1" class="w-12 h-12 rounded-full mr-4">
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
                        <img src="https://source.unsplash.com/random/100x100/?man" alt="Testimonial 2" class="w-12 h-12 rounded-full mr-4">
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
                        <img src="https://source.unsplash.com/random/100x100/?woman" alt="Testimonial 3" class="w-12 h-12 rounded-full mr-4">
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
                    <img src="https://source.unsplash.com/random/400x500/?singer" alt="Artist 1" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Nova Aurora</h3>
                        <p class="text-gray-300">Headlining Performance</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://source.unsplash.com/random/400x500/?musician" alt="Artist 2" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Pulse Collective</h3>
                        <p class="text-gray-300">Electronic Ensemble</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://source.unsplash.com/random/400x500/?band" alt="Artist 3" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black to-transparent">
                        <h3 class="title-font text-xl mb-2">Stellar Dreams</h3>
                        <p class="text-gray-300">Visual Performance</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://source.unsplash.com/random/400x500/?performance" alt="Artist 4" class="w-full h-[400px] object-cover transition-transform group-hover:scale-110">
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
                    <img src="https://source.unsplash.com/random/800x600/?stadium" alt="Venue" class="w-full h-[400px] object-cover">
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
                    <input type="email" placeholder="Enter your email" class="bg-black/30 border border-[#025f92] rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-[#025f92]">
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
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+1" alt="Sponsor 1" class="w-full opacity-50 hover:opacity-100 transition-opacity">
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+2" alt="Sponsor 2" class="w-full opacity-50 hover:opacity-100 transition-opacity">
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+3" alt="Sponsor 3" class="w-full opacity-50 hover:opacity-100 transition-opacity">
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://via.placeholder.com/200x80?text=Sponsor+4" alt="Sponsor 4" class="w-full opacity-50 hover:opacity-100 transition-opacity">
                </div>
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

        // Parallax Effect
        document.addEventListener('scroll', () => {
            const parallaxElements = document.querySelectorAll('[data-speed]');
            parallaxElements.forEach(element => {
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
    </script>
</body>
</html>