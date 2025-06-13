<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        input { display: block; margin: 15px 0; padding: 10px; width: 100%; }
        button { padding: 10px; background: #cc0000; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
<form method="POST">
    <h2>Create an Account</h2>
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button name="signup">Sign Up</button>
</form>

<?php
if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $check->execute([$username]);
    if ($check->rowCount() > 0) {
        echo "<p style='color:red;'>Username already taken.</p>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        echo "<p style='color:green;'>Signup successful. You can <a href='login.php'>login here</a>.</p>";
    }
}
?>
</body>
</html>
