<?php include 'db.php'; $cat = $_GET['cat']; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $cat; ?> News</title>
    <style>
        body { font-family: Arial; margin: 0; background: #f9f9f9; }
        header { background: #cc0000; padding: 15px; color: white; text-align: center; font-size: 22px; }
        .container { padding: 20px; }
        .card { background: white; padding: 15px; margin: 10px 0; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        .card img { width: 100%; border-radius: 8px; }
    </style>
</head>
<body>
<header><?php echo htmlspecialchars($cat); ?> News</header>
<div class="container">
<?php
$stmt = $pdo->prepare("SELECT a.* FROM articles a JOIN categories c ON a.category_id = c.id WHERE c.name = ?");
$stmt->execute([$cat]);
while ($row = $stmt->fetch()) {
    echo "<div class='card'>
        <img src='assets/{$row['image']}' alt=''>
        <h2>{$row['title']}</h2>
        <p>" . substr($row['content'], 0, 150) . "...</p>
        <button onclick=\"redirect('article.php?id={$row['id']}')\">Read More</button>
    </div>";
}
?>
</div>
</body>
<script>
    function redirect(url) {
        window.location.href = url;
    }
</script>
</html>
