<?php
function logActivity($conn, $user_id, $role, $action) {
    $stmt = $conn->prepare("INSERT INTO logs (user_id, role, action) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("iss", $user_id, $role, $action);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
}

?>
