<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Team Amerta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
        }

        .team-title {
            text-align: center;
            margin-top: 50px;
            font-weight: 700;
            font-size: 2.5rem;
            color: #222;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .filter-menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 30px 0 40px 0;
            gap: 15px;
        }

        .filter-menu button {
            border: none;
            background-color: #d1d9e6;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            color: #555;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .filter-menu button.active,
        .filter-menu button:hover {
            background-color: #0056b3;
            color: white;
            box-shadow: 0 6px 12px rgba(0, 86, 179, 0.6);
            transform: translateY(-3px);
        }

        .team-member {
            display: none;
            margin-bottom: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .team-member img {
            width: 100%;
            border-radius: 15px 15px 0 0;
            object-fit: cover;
            height: 250px;
            transition: transform 0.4s ease;
        }

        .team-member:hover img {
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            padding: 25px;
            background-color: #222;
            color: #ddd;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>

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
                        <a class="nav-link" href="gallery-1.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="team.php">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="team-title">TEAM AMERTA</h2>

        <div class="filter-menu my-4">
            <button class="active" data-filter="all">All</button>
            <button data-filter="pubdok">Pubdok</button>
            <button data-filter="acara">Acara</button>
            <button data-filter="perkap">Perkap</button>
            <button data-filter="dekor">Dekor</button>
            <button data-filter="fundraising">Fundraising</button>
            <button data-filter="konsumsi">Konsumsi</button>
        </div>

        <div class="row" id="team-container">
            <!-- PUBDOK -->
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/1.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/2.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/3.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/4.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/5.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/6.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/7.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/8.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/9.webp" alt="pubdok 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="pubdok">
                <img src="img/faces/pubdok/10.webp" alt="pubdok 1">
            </div>


            <!-- ACARA -->
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/1.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/2.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/3.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/4.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/5.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/6.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/7.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/8.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/9.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/10.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/11.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/12.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/13.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/14.webp" alt="acara 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="acara">
                <img src="img/faces/acara/15.webp" alt="acara 1">
            </div>


            <!-- PERKAP -->
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/1.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/2.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/3.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/4.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/5.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/6.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/7.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/8.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/9.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/10.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/11.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/12.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/13.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/14.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/15.webp" alt="perkap 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="perkap">
                <img src="img/faces/perkap/16.webp" alt="perkap 1">
            </div>


            <!-- DEKOR -->
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/1.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/2.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/3.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/4.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/5.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/6.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/7.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/8.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/9.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/10.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/11.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/12.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/13.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/14.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/15.webp" alt="dekor 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="dekor">
                <img src="img/faces/dekor/16.webp" alt="dekor 1">
            </div>

            <!-- FUNDRAISING -->
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/1.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/2.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/3.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/4.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/5.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/6.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/7.webp" alt="fundraising 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="fundraising">
                <img src="img/faces/fundraising/8.webp" alt="fundraising 1">
            </div>


            <!-- KONSUMSI -->
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/1.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/2.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/3.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/4.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/5.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/6.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/7.webp" alt="konsumsi 1">
            </div>
            <div class="col-4 col-md-3 team-member" data-category="konsumsi">
                <img src="img/faces/konsumsi/8.webp" alt="konsumsi 1">
            </div>
        </div>
    </div>

    <div class="footer">© 2025 Team Amerta | Built with 💙 using Bootstrap</div>

    <script>
        const filterButtons = document.querySelectorAll('.filter-menu button');
        const members = document.querySelectorAll('.team-member');

        function showFiltered(category) {
            const container = document.getElementById('team-container');
            if (category === 'all') {
                // Shuffle the members array
                let membersArray = Array.from(members);
                for (let i = membersArray.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [membersArray[i], membersArray[j]] = [membersArray[j], membersArray[i]];
                }
                // Clear container and append shuffled members
                container.innerHTML = '';
                membersArray.forEach(member => {
                    member.style.display = 'block';
                    container.appendChild(member);
                });
            } else {
                members.forEach(member => {
                    const cat = member.getAttribute('data-category');
                    if (cat === category) {
                        member.style.display = 'block';
                    } else {
                        member.style.display = 'none';
                    }
                    // Append members back to container in original order for non-all filters
                    container.appendChild(member);
                });
            }
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Hapus kelas active dari semua tombol
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Tambahkan kelas active ke tombol yang diklik
                button.classList.add('active');
                // Tampilkan gambar yang sesuai
                const filter = button.getAttribute('data-filter');
                showFiltered(filter);
            });
        });

        // Tampilkan semua di awal
        showFiltered('all');
    </script>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>

</body>

</html>