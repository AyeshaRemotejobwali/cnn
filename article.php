<?php include 'db.php'; $id = $_GET['id']; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Article</title>
    <style>
        body { font-family: Arial; margin: 0; background: #fff; }
        header { background: #cc0000; padding: 20px; color: white; text-align: center; font-size: 24px; }
        .container { padding: 20px; max-width: 800px; margin: auto; }
        img { width: 100%; margin-bottom: 20px; border-radius: 10px; }
        h1 { margin-bottom: 10px; }
        p { line-height: 1.6; }
    </style>
</head>
<body>
<header>Full Article</header>
<div class="container">
<?php
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
echo "<h1>{$row['title']}</h1>";
echo "<img src='assets/{$row['image']}' alt=''>";
echo "<p>{$row['content']}</p>";
?>
</div>
</body>
</html>
