<?php
$hostname = 'localhost';
$username = 'u255726978_amerta_db';
$password = '!Wops5Wj@5';
$database = 'u255726978_amerta_db';

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $instagram = $division = "";
$name_err = $instagram_err = $division_err = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate instagram username
    if (empty(trim($_POST["instagram"]))) {
        $instagram_err = "Please enter an Instagram username.";
    } else {
        $instagram = trim($_POST["instagram"]);
    }

    // Validate division
    $valid_divisions = ['pubdok', 'acara', 'perkap', 'dekor', 'fundraising', 'konsumsi'];
    if (empty($_POST["division"]) || !in_array($_POST["division"], $valid_divisions)) {
        $division_err = "Please select a valid division.";
    } else {
        $division = $_POST["division"];
    }

    // Validate image upload
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        $image_err = "Please upload an image.";
    } else {
        $image_err = "";
        $image_tmp_path = $_FILES['image']['tmp_name'];
        $image_type = mime_content_type($image_tmp_path);
        if ($image_type !== 'image/webp') {
            $image_err = "Only .webp images are allowed.";
        }
    }

    // If no errors, insert into database and save image
    if (empty($name_err) && empty($instagram_err) && empty($division_err) && empty($image_err)) {
        $stmt = $conn->prepare("INSERT INTO team (name, instagram, division) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $instagram, $division);
        if ($stmt->execute()) {
            $team_id = $stmt->insert_id;
            $stmt->close();

            // Save image file
            $upload_dir = __DIR__ . "/img/faces/" . $division;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $image_path = $upload_dir . "/" . $team_id . ".webp";
            if (move_uploaded_file($image_tmp_path, $image_path)) {
                // Update image_ext column in team table
                $stmt_img = $conn->prepare("UPDATE team SET image_ext = ? WHERE id = ?");
                $ext = 'webp';
                $stmt_img->bind_param("si", $ext, $team_id);
                $stmt_img->execute();
                $stmt_img->close();

                $success_msg = "Team member and image added successfully.";
                $name = $instagram = $division = "";
            } else {
                $success_msg = "Failed to save the uploaded image.";
            }
        } else {
            $success_msg = "Error: Could not execute the query. " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Team Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .error {
            color: #d9534f;
            font-size: 0.9rem;
        }
        .success {
            color: #28a745;
            font-size: 1rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Team Member</h2>
        <?php if ($success_msg): ?>
            <div class="alert alert-success"><?php echo $success_msg; ?></div>
        <?php endif; ?>
        <form action="team_form.php" method="post" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                <div class="error"><?php echo $name_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram Username</label>
                <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo htmlspecialchars($instagram); ?>">
                <div class="error"><?php echo $instagram_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="division" class="form-label">Division</label>
                <select name="division" id="division" class="form-select">
                    <option value="">Select Division</option>
                    <option value="pubdok" <?php if ($division == 'pubdok') echo 'selected'; ?>>Pubdok</option>
                    <option value="acara" <?php if ($division == 'acara') echo 'selected'; ?>>Acara</option>
                    <option value="perkap" <?php if ($division == 'perkap') echo 'selected'; ?>>Perkap</option>
                    <option value="dekor" <?php if ($division == 'dekor') echo 'selected'; ?>>Dekor</option>
                    <option value="fundraising" <?php if ($division == 'fundraising') echo 'selected'; ?>>Fundraising</option>
                    <option value="konsumsi" <?php if ($division == 'konsumsi') echo 'selected'; ?>>Konsumsi</option>
                </select>
                <div class="error"><?php echo $division_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image (.webp only)</label>
                <input type="file" name="image" id="image" class="form-control" accept=".webp">
                <div class="error"><?php echo isset($image_err) ? $image_err : ''; ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Add Member</button>
        </form>
    </div>
</body>
</html>
