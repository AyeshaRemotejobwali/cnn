<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $updateStmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
    $updateStmt->execute([$title, $content, $id]);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
</head>
<body>
    <h2>Edit Article</h2>
    <form method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        <button type="submit" name="update">Update Article</button>
    </form>
</body>
</html>
