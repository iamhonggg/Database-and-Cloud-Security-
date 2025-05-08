<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    echo "Access denied.";
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Corrected SQL query using user_id and booking_date
$sql = "
    SELECT 
        bookings.booking_id, 
        users.username, 
        movies.movie_name, 
        movies.showtime, 
        bookings.booking_date
    FROM bookings
    JOIN users ON bookings.user_id = users.user_id
    JOIN movies ON bookings.movie_id = movies.movie_id
    ORDER BY bookings.booking_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Bookings - Staff Dashboard</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #3498db;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .back-link:hover {
            background: #217dbb;
        }
    </style>
</head>
<body>
    <h2>Customer Bookings</h2>
    
    <table>
        <tr>
            <th>Username</th>
            <th>Movie Name</th>
            <th>Showtime</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['movie_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['showtime']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No bookings found.</td></tr>
        <?php endif; ?>
    </table>

    <a href="staff_dashboard.php" class="back-link">← Back to Dashboard</a>
</body>
</html>
