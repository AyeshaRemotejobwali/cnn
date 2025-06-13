<?php include 'db.php'; session_start(); if (!isset($_SESSION['admin'])) header("Location: login.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
</head>
<body>
<h2>Add New Article</h2>
<form method="POST">
    <input name="title" placeholder="Title" required><br><br>
    <textarea name="content" placeholder="Content" rows="10" cols="50" required></textarea><br><br>
    <input name="image" placeholder="Image filename" required><br><br>
    <select name="category_id">
        <?php
        $cats = $pdo->query("SELECT * FROM categories");
        while ($c = $cats->fetch()) echo "<option value='{$c['id']}'>{$c['name']}</option>";
        ?>
    </select><br><br>
    <button name="submit">Add</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, image, category_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['content'], $_POST['image'], $_POST['category_id']]);
    echo "Article added!";
}
?>
</body>
</html>
