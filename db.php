<?php
$host = "localhost";
$dbname = "dbuwqgwebgsagi";
$username = "uxgukysg8xcbd";
$password = "6imcip8yfmic";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
