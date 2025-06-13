<?php
session_start();
require 'db.php';  // Database connection

// Check if the user is already logged in
if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to get user data from database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['admin'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; height: 100vh; }
        form { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; }
        input, button { width: 100%; margin-top: 10px; padding: 10px; }
        h2 { text-align: center; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
<form method="POST">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
</form>
</body>
</html>
