<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");
$result = $conn->query("SELECT * FROM movies");

$role = strtolower(trim($_SESSION['role']));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Cinema Booking System</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2, h3 {
            color: #2c3e50;
        }

        a.add-btn {
            background: #3498db;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        a.add-btn:hover {
            background: #2980b9;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 6px;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .message {
            color: green;
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Role: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <?php if ($role === 'admin'): ?>
        <h3>Movie List</h3>

        <p>
            <a class="add-btn" href="add_movie.php">➕ Add New Movie</a>
        </p>

        <?php if (isset($_GET['deleted'])): ?>
            <p class="message">Movie deleted successfully.</p>
        <?php endif; ?>

        <table>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Showtime</th>
                <th>Actions</th>
            </tr>
            <?php $counter = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['genre'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['showtime']); ?></td>
                    <td>
                        <a class="delete-btn" href="delete_movie.php?id=<?php echo $row['movie_id']; ?>" onclick="return confirm('Are you sure you want to delete this movie?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <?php if ($role === 'staff'): ?>
            <p>You are logged in as staff. Movie management is restricted to admins only.</p>
        <?php else: ?>
            <p>Your role (<?php echo htmlspecialchars($_SESSION['role']); ?>) is not authorized to manage movies.</p>
        <?php endif; ?>
    <?php endif; ?>
    
</body>
</html>