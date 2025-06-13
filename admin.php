<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
}

$articles = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .container { width: 80%; margin: auto; background: #fff; padding: 20px; margin-top: 40px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        form { margin-top: 20px; }
        input, textarea, button { width: 100%; padding: 10px; margin-top: 10px; }
        a.btn { padding: 6px 12px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; margin-right: 5px; }
        a.btn:hover { background: #0056b3; }
        a.delete { background: #dc3545; }
        a.delete:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></h2>

        <h3>Add New Article</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit" name="submit">Add Article</button>
        </form>

        <h3>All Articles</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo htmlspecialchars($article['title']); ?></td>
                <td><?php echo htmlspecialchars(substr($article['content'], 0, 100)); ?>...</td>
                <td>
                    <a class="btn" href="edit.php?id=<?php echo $article['id']; ?>">Edit</a>
                    <a class="btn delete" href="delete.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
