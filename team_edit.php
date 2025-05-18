<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Team Members - Amerta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .container {
            margin-top: 50px;
        }

        .table thead th {
            background-color: #0d6efd;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-action {
            min-width: 75px;
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
                        <a class="nav-link" href="team.php">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="team_edit.php">Edit Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4 text-center">Edit Team Members</h2>

        <div class="filter-menu my-4 d-flex justify-content-center flex-wrap gap-3">
<?php
// Fetch distinct divisions for filter buttons
$divisions_sql = "SELECT DISTINCT division FROM team ORDER BY division";
$divisions_result = $conn->query($divisions_sql);
if ($divisions_result && $divisions_result->num_rows > 0) {
    while ($div_row = $divisions_result->fetch_assoc()) {
        $div = htmlspecialchars($div_row['division']);
        echo "<button class=\"btn btn-outline-primary\" data-filter=\"$div\">" . ucfirst($div) . "</button>";
    }
}
?>
        </div>

        <?php
        $hostname = 'localhost';
        $username = 'u255726978_amerta_db';
        $password = '!Wops5Wj@5';
        $database = 'u255726978_amerta_db';

        // Create connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
        }

        // Handle update POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['name'], $_POST['instagram'])) {
            $id = intval($_POST['id']);
            $name = $conn->real_escape_string(trim($_POST['name']));
            $instagram = $conn->real_escape_string(trim($_POST['instagram']));

            if ($name === '' || $instagram === '') {
                echo "<div class='alert alert-warning'>Name and Instagram cannot be empty.</div>";
            } else {
                $update_sql = "UPDATE team SET name='$name', instagram='$instagram' WHERE id=$id";
                if ($conn->query($update_sql) === TRUE) {
                    echo "<div class='alert alert-success'>Record updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
                }
            }
        }

        // Fetch all team members ordered by division and name
        $sql = "SELECT * FROM team ORDER BY division, name";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-bordered align-middle">';
            echo '<thead><tr><th>Name</th><th>Instagram</th><th>Division</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['name']);
                $instagram = htmlspecialchars($row['instagram']);
                $division = htmlspecialchars($row['division']);
                echo "<tr data-id=\"$id\" data-division=\"$division\">";
                echo "<td class=\"name-cell\">$name</td>";
                echo "<td class=\"instagram-cell\">$instagram</td>";
                echo "<td>$division</td>";
                echo "<td>";
                echo "<button class=\"btn btn-primary btn-sm btn-action edit-btn\">Edit</button>";
                echo "<button class=\"btn btn-success btn-sm btn-action save-btn d-none\">Save</button>";
                echo "<button class=\"btn btn-secondary btn-sm btn-action cancel-btn d-none\">Cancel</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo '</tbody></table>';
        } else {
            echo "<div class='alert alert-info'>No team members found.</div>";
        }

        $conn->close();
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('table');
            if (!table) return;

            const filterButtons = document.querySelectorAll('.filter-menu button');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    button.classList.add('active');

                    const filter = button.getAttribute('data-filter');
                    rows.forEach(row => {
                        if (filter === 'all' || row.getAttribute('data-division') === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });

            table.addEventListener('click', function (e) {
                const target = e.target;
                if (target.classList.contains('edit-btn')) {
                    const row = target.closest('tr');
                    enterEditMode(row);
                } else if (target.classList.contains('cancel-btn')) {
                    const row = target.closest('tr');
                    exitEditMode(row);
                } else if (target.classList.contains('save-btn')) {
                    const row = target.closest('tr');
                    saveChanges(row);
                }
            });

            function enterEditMode(row) {
                const nameCell = row.querySelector('.name-cell');
                const instagramCell = row.querySelector('.instagram-cell');
                const nameText = nameCell.textContent;
                const instagramText = instagramCell.textContent;

                nameCell.innerHTML = `<input type="text" class="form-control form-control-sm" value="${nameText}">`;
                instagramCell.innerHTML = `<input type="text" class="form-control form-control-sm" value="${instagramText}">`;

                toggleButtons(row, true);
            }

            function exitEditMode(row) {
                const nameCell = row.querySelector('.name-cell');
                const instagramCell = row.querySelector('.instagram-cell');
                const nameInput = nameCell.querySelector('input');
                const instagramInput = instagramCell.querySelector('input');

                nameCell.textContent = nameInput.defaultValue;
                instagramCell.textContent = instagramInput.defaultValue;

                toggleButtons(row, false);
            }

            function saveChanges(row) {
                const id = row.getAttribute('data-id');
                const nameInput = row.querySelector('.name-cell input');
                const instagramInput = row.querySelector('.instagram-cell input');
                const name = nameInput.value.trim();
                const instagram = instagramInput.value.trim();

                if (name === '' || instagram === '') {
                    alert('Name and Instagram cannot be empty.');
                    return;
                }

                // Create a form and submit POST request to update the record
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';

                const idInput = document.createElement('input');
                idInput.name = 'id';
                idInput.value = id;
                form.appendChild(idInput);

                const nameField = document.createElement('input');
                nameField.name = 'name';
                nameField.value = name;
                form.appendChild(nameField);

                const instagramField = document.createElement('input');
                instagramField.name = 'instagram';
                instagramField.value = instagram;
                form.appendChild(instagramField);

                document.body.appendChild(form);
                form.submit();
            }

            function toggleButtons(row, editing) {
                row.querySelector('.edit-btn').classList.toggle('d-none', editing);
                row.querySelector('.save-btn').classList.toggle('d-none', !editing);
                row.querySelector('.cancel-btn').classList.toggle('d-none', !editing);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
