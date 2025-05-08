<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");

// Fetch available movies from the database
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);

// Fetch the customer's own bookings
$user_id = $_SESSION['user_id'];
$booking_sql = "SELECT b.booking_id, m.movie_name, m.showtime, m.duration
                FROM bookings b
                JOIN movies m ON b.movie_id = m.movie_id
                WHERE b.user_id = ?";
$booking_stmt = $conn->prepare($booking_sql);
$booking_stmt->bind_param("i", $user_id);
$booking_stmt->execute();
$bookings_result = $booking_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Cinema Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
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

        .movie-list {
            margin-top: 20px;
        }

        .movie-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .movie-card h3 {
            margin: 0;
        }

        .movie-card .btn-book {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .movie-card .btn-book:hover {
            background-color: #2980b9;
        }

        .booking-list {
            margin-top: 20px;
        }

        .booking-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .booking-card h3 {
            margin: 0;
        }

        .booking-card p {
            margin: 5px 0;
        }

        .logout-btn {
            background-color: #555;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <a href="logout.php" class="logout-btn">Logout</a>

    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Here are the available movies you can book:</p>

        <!-- Display available movies -->
        <div class="movie-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($movie = $result->fetch_assoc()): ?>
                    <div class="movie-card">
                        <div>
                            <h3><?php echo $movie['movie_name']; ?></h3>
                            <p>Duration: <?php echo $movie['duration']; ?> minutes</p>
                            <p>Showtime: <?php echo $movie['showtime']; ?></p>
                        </div>
                        <form action="book_movie.php" method="POST">
                            <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                            <button type="submit" class="btn-book">Book Now</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No movies available right now. Please check back later.</p>
            <?php endif; ?>
        </div>

        <!-- Display customer's current bookings -->
        <div class="booking-list">
            <h2>Your Bookings</h2>
            <?php if ($bookings_result->num_rows > 0): ?>
                <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                    <div class="booking-card">
                        <h3><?php echo $booking['movie_name']; ?></h3>
                        <p>Showtime: <?php echo $booking['showtime']; ?></p>
                        <p>Duration: <?php echo $booking['duration']; ?> minutes</p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You have no bookings at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
