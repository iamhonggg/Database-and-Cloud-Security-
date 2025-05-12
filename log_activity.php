<?php
function logActivity($conn, $user_id, $role, $action) {
    $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, role, action) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $role, $action);
    $stmt->execute();
    $stmt->close();
}
?>
