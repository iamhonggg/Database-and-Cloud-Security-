<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cinema Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            position: relative; /* Make sure the body is relative to position elements inside */
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2c3e50;
            margin-top: 0;
        }

        .nav-links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .nav-links a {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }

        .nav-links a:hover {
            background-color: #2980b9;
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

        .header-container h2 {
            margin: 0;
            color: #2980b9;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="header-container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Your admin dashboard is ready to manage movies and bookings.</p>
        </div>

        <div class="nav-links">
            <a href="add_movie.php">Add Movie</a>
        </div>

    </div>

    <a href="logout.php" class="logout-btn">Logout</a> <!-- Logout button positioned at top-right -->

    <div class="footer">
        <p>&copy; 2025 Cinema Booking System</p>
    </div>

</body>
</html>
