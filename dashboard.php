<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    exit();
}


$host = 'localhost';
$db = 'cinema_booking';  
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlMovies = "SELECT * FROM movies";  
$resultMovies = $conn->query($sqlMovies);

$sqlBookings = "SELECT * FROM bookings WHERE user_id = ?";  
$stmtBookings = $conn->prepare($sqlBookings);
$stmtBookings->bind_param("i", $_SESSION['user_id']);
$stmtBookings->execute();
$resultBookings = $stmtBookings->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <style>
        
    </style>
</head>
<body>
    <h1>Welcome, Customer</h1>
    <h2>Available Movies</h2>

    <form action="book_movie.php" method="POST">
        <label>Select a movie to book:</label>
        <select name="movie_id" required>
            <?php while ($movie = $resultMovies->fetch_assoc()) { ?>
                <option value="<?= $movie['movie_id']; ?>"><?= $movie['movie_name']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Book Movie">
    </form>

    <h2>Your Bookings</h2>
    <?php if ($resultBookings->num_rows > 0) { ?>
        <ul>
            <?php while ($booking = $resultBookings->fetch_assoc()) { ?>
                <li><?= $booking['movie_name']; ?> - <?= $booking['booking_date']; ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>You have no bookings yet.</p>
    <?php } ?>
</body>
</html>
