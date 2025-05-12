<?php
session_start();

define('SESSION_TIMEOUT', 300);

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > SESSION_TIMEOUT)) {
    session_unset();     
    session_destroy();   
    header("Location: login.php?timeout=1"); 
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

require_once 'log_activity.php';

$conn = new mysqli("localhost", "root", "", "cinema_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

logActivity($conn, $_SESSION['user_id'], $_SESSION['role'], "Accessed admin dashboard");
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
            position: relative; 
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
            <p>Your admin dashboard is ready to add movies.</p>
        </div>

        <div class="nav-links">
            <a href="add_movie.php">Add Movie</a>
            <a href="view_logs.php">View Admin Logs</a>
        </div>

    </div>

    <a href="logout.php" class="logout-btn">Logout</a> 

    <div class="footer">
        <p>&copy; 2025 Cinema Booking System</p>
    </div>

</body>
</html>
