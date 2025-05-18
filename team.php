<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Team Amerta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }

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
            height: 100%;
            transition: transform 0.4s ease;
            display: block;
        }

        .team-member:hover img {
            transform: scale(1.05);
        }

        .team-link {
            position: relative;
            display: block;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
            cursor: pointer;
        }

        .team-link img {
            display: block;
            width: 100%;
            height: 100%;
            transition: 0.4s ease;
        }

        .team-link .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.4s ease;
            border-radius: 15px 15px 0 0;
            text-transform: capitalize;
        }

        .team-link:hover img {
            filter: brightness(50%);
            transform: scale(1.05);
        }

        .team-link:hover .overlay {
            opacity: 1;
        }

        .footer {
            background-color: #1f2e2e;
            color: white;
            padding: 0 0;
            text-align: center;
            margin-top: 60px;
            font-weight: 300;
            font-size: 0.9rem;
            letter-spacing: 1.5px;
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
                        <a class="nav-link" href="program-detail.php">Show</a>
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
            <button data-filter="bph">BPH</button>
        </div>

        <div class="row" id="team-container">
            <?php
            $hostname = 'localhost';
            $username = 'u255726978_amerta_db';
            $password = '!Wops5Wj@5';
            $database = 'u255726978_amerta_db';

            // Create connection
            $conn = new mysqli($hostname, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch all team members
            $sql = "SELECT * FROM team ORDER BY division, name";
            $result = $conn->query($sql);

            $members_by_division = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $members_by_division[$row['division']][] = $row;
                }
            }

            // Render members grouped by division with image filename derived from member id
            foreach ($members_by_division as $division => $members) {
                foreach ($members as $member) {
                    $img_path = "img/faces/" . $division . "/" . $member['id'] . ".webp";
                    $instagram_url = "https://www.instagram.com/" . htmlspecialchars($member['instagram']);
                    echo '<div class="col-4 col-md-3 team-member" data-category="' . htmlspecialchars($division) . '">';
                    echo '<a href="' . $instagram_url . '" target="_blank" class="team-link">';
                    echo '<img src="' . htmlspecialchars($img_path) . '" alt="' . htmlspecialchars($member['name']) . '">';
                    echo '<div class="overlay">' . htmlspecialchars($member['name']) . '</div>';
                    echo '</a></div>';
                }
            }

            $conn->close();
            ?>


        </div>

        <footer class="bg-dark text-light py-4 mt-5">
            <div class="container text-center">
                <p class="mb-2">&copy; 2024 Amerta. All rights reserved.</p>
                <div>
                    <a href="#" class="text-light me-3" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-3" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </footer>
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
                    // Filter members by category and shuffle them
                    let filteredMembers = Array.from(members).filter(member => member.getAttribute('data-category') === category);
                    for (let i = filteredMembers.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [filteredMembers[i], filteredMembers[j]] = [filteredMembers[j], filteredMembers[i]];
                    }
                    // Hide all members first
                    members.forEach(member => {
                        member.style.display = 'none';
                    });
                    // Clear container and append shuffled filtered members
                    container.innerHTML = '';
                    filteredMembers.forEach(member => {
                        member.style.display = 'block';
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
</body>

</html>