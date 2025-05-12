<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");

$result = $conn->query("
    SELECT logs.id, users.username, logs.role, logs.action, logs.timestamp 
    FROM logs 
    JOIN users ON logs.user_id = users.user_id 
    ORDER BY logs.timestamp DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Logs - Cinema Booking System</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        a.back { display: inline-block; margin-top: 15px; color: #3498db; text-decoration: none; }
        a.back:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Action Logs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Admin</th>
                <th>Role</th>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td><?= htmlspecialchars($row['action']) ?></td>
                    <td><?= htmlspecialchars($row['timestamp']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="admin_dashboard.php" class="back">← Back to Dashboard</a>
    </div>
</body>
</html>
