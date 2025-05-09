<?php
session_start();

if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    echo "<p style='color: red; text-align: center;'>Session expired due to inactivity. Please log in again.</p>";
}

$conn = new mysqli("localhost", "root", "", "cinema_booking");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from database
    $stmt = $conn->prepare("SELECT user_id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($_SESSION['role'] == 'customer') {
            header("Location: customer_dashboard.php");
            exit();
        } elseif ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        } elseif ($_SESSION['role'] == 'staff') {
            header("Location: staff_dashboard.php");
            exit();
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cinema Booking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1c1c1c;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #2c2c2c;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f0db4f;
        }

        .login-container label {
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: #444;
            color: #fff;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #f0db4f;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            color: #000;
        }

        .login-container input[type="submit"]:hover {
            background: #e5c945;
        }

        .error {
            color: #e74c3c;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Cinema Booking Login</h2>
        <form action="login.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
