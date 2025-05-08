<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    echo "Access denied.";
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['movie_id'])) {
        echo "No movie selected.";
        exit();
    }

    $movie_id = intval($_GET['movie_id']);

    // Get movie details to confirm
    $stmt = $conn->prepare("SELECT movie_name, showtime FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();

    if (!$movie) {
        echo "Movie not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = intval($_POST['movie_id']);

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $movie_id);

    if ($stmt->execute()) {
        $success = "Movie booked successfully!";
    } else {
        $error = "Booking failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Movie - Cinema Booking</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
        }

        .movie-details {
            background-color: #ecf0f1;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .movie-details p {
            font-size: 18px;
            color: #34495e;
            margin: 10px 0;
        }

        .movie-details strong {
            font-weight: bold;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .message {
            padding: 10px;
            margin: 10px 0;
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Book Movie</h2>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
            <a href="customer_dashboard.php" class="back-link">Back to Dashboard</a>
        <?php elseif (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
            <a href="customer_dashboard.php" class="back-link">Back to Dashboard</a>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
            <div class="movie-details">
                <p><strong>Movie:</strong> <?php echo $movie['movie_name']; ?></p>
                <p><strong>Showtime:</strong> <?php echo $movie['showtime']; ?></p>
            </div>

            <form method="POST">
                <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                <button type="submit" class="btn">Confirm Booking</button>
            </form>
            <a href="customer_dashboard.php" class="back-link">Cancel and go back</a>
        <?php endif; ?>
    </div>

</body>
</html>
