<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    echo "Access denied.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 700px;
            margin: 60px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            padding: 40px;
            position: relative;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-top: 0;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
            text-align: center;
        }

        li {
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #2980b9;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            background-color: #e74c3c;
            padding: 10px 16px;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <a href="logout.php" class="logout-btn">Logout</a>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <ul>
            <li><a href="view_customer_bookings.php">View Customer Bookings</a></li>
        </ul>
    </div>
</body>
</html>
