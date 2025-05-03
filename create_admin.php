<?php
$conn = new mysqli("localhost", "root", "", "cinema_booking");

// Create a default admin user
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); // Hash the password
$role = "admin";

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);

if ($stmt->execute()) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $stmt->error;
}
?>
