<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>CNN Clone - Home</title>
    <style>
        body { margin: 0; font-family: Arial; background: #f4f4f4; }
        header { background: #cc0000; color: white; padding: 20px; text-align: center; font-size: 24px; }
        nav { background: #e60000; display: flex; justify-content: center; padding: 10px; }
        nav a { margin: 0 15px; color: white; text-decoration: none; font-weight: bold; }
        .featured, .category-section { padding: 20px; }
        .card { background: white; padding: 15px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card img { width: 100%; border-radius: 8px; }
        .card h2 { margin: 10px 0 5px; }
        .card p { color: #555; }
        @media (min-width: 768px) {
            .news-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        }
    </style>
</head>
<body>
<header>CNN Clone</header>
<nav>
    <a href="#" onclick="redirect('category.php?cat=World')">World</a>
    <a href="#" onclick="redirect('category.php?cat=Sports')">Sports</a>
    <a href="#" onclick="redirect('category.php?cat=Technology')">Technology</a>
    <a href="#" onclick="redirect('category.php?cat=Entertainment')">Entertainment</a>
</nav>

<div class="featured">
    <h1>Featured News</h1>
    <div class="news-grid">
    <?php
    $stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT 2");
    while ($row = $stmt->fetch()) {
        echo "<div class='card'>
            <img src='assets/{$row['image']}' alt=''>
            <h2>{$row['title']}</h2>
            <p>" . substr($row['content'], 0, 100) . "...</p>
            <button onclick=\"redirect('article.php?id={$row['id']}')\">Read More</button>
        </div>";
    }
    ?>
    </div>
</div>
</body>
<script>
    function redirect(url) {
        window.location.href = url;
    }
</script>
</html>
