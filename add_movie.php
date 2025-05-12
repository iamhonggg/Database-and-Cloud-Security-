<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "Access denied.";
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? 0;
    $showtime = $_POST['showtime'] ?? '';

    if (!empty($title) && !empty($duration) && !empty($showtime)) {
        $stmt = $conn->prepare("INSERT INTO movies (movie_name, duration, showtime) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $title, $duration, $showtime);

        if ($stmt->execute()) {
            $success = "Movie added successfully.";

            $log_stmt = $conn->prepare("INSERT INTO logs (user_id, role, action, timestamp) VALUES (?, ?, ?, NOW())");
            $action = "Added movie: " . $title;
            $log_stmt->bind_param("iss", $_SESSION['user_id'], $_SESSION['role'], $action);
            $log_stmt->execute();
            
        } else {
            $error = "Error adding movie: " . $conn->error;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movie - Cinema Booking System</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #2980b9;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #555;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #333;
        }

        .header-container {
            position: relative;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h2>Add New Movie</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?> <a href="admin_dashboard.php">Go back to dashboard</a></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
            </div>

            <div class="form-group">
                <label for="duration">Duration (minutes):</label>
                <input type="number" id="duration" name="duration" required>
            </div>

            <div class="form-group">
                <label for="showtime">Showtime (YYYY-MM-DD HH:MM:SS):</label>
                <input type="text" id="showtime" name="showtime" placeholder="2023-12-25 18:30:00" required>
            </div>

            <input type="submit" value="Add Movie">
            <a href="dashboard.php" class="back-link">Cancel and go back</a>
        </form>
    </div>
</body>
</html>
