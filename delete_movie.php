<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

require_once 'log_activity.php';

$conn = new mysqli("localhost", "root", "", "cinema_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['movie_id'])) {
    $movie_id = intval($_GET['movie_id']);

    $name_stmt = $conn->prepare("SELECT movie_name FROM movies WHERE movie_id = ?");
    $name_stmt->bind_param("i", $movie_id);
    $name_stmt->execute();
    $name_stmt->bind_result($movie_name);
    $name_stmt->fetch();
    $name_stmt->close();

    $stmt = $conn->prepare("DELETE FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movie_id);

    if ($stmt->execute()) {
        logActivity($conn, $_SESSION['user_id'], $_SESSION['role'], "Deleted movie: $movie_name");

        header("Location: manage_movies.php?deleted=1");
        exit();
    } else {
        echo "Error deleting movie.";
    }

    $stmt->close();
}
$conn->close();
?>
