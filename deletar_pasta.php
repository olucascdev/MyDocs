<?php
$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");
$id = $_GET["id"];
$pdo->prepare("DELETE FROM pastas WHERE id = ?")->execute([$id]);
header("Location: index.php");
