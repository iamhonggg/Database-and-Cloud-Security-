<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM movies");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Movies</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<h2>Manage Movies</h2>

<?php if (isset($_GET['deleted'])): ?>
    <p style="color: green;">Movie deleted successfully.</p>
<?php endif; ?>

<table>
    <tr>
        <th>Movie ID</th>
        <th>Movie Name</th>
        <th>Duration</th>
        <th>Showtime</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['movie_id']) ?></td>
        <td><?= htmlspecialchars($row['movie_name']) ?></td>
        <td><?= htmlspecialchars($row['duration']) ?></td>
        <td><?= htmlspecialchars($row['showtime']) ?></td>
        <td>
            <a class="delete-btn" href="delete_movie.php?movie_id=<?= $row['movie_id'] ?>" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="admin_dashboard.php" style="
    display: inline-block;
    margin-top: 20px;
    padding: 10px 16px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
">← Back to Dashboard</a>

</body>
</html>

<?php $conn->close(); ?>
