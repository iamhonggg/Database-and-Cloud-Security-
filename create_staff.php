<?php
$conn = new mysqli("localhost", "root", "", "cinema_booking");

$username = "staff";
$password = password_hash("staff123", PASSWORD_DEFAULT); // secure
$role = "staff";

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);

if ($stmt->execute()) {
    echo "Staff user created successfully.";
} else {
    echo "Error: " . $stmt->error;
}
?>
