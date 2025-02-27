<?php
$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $pdo->prepare("INSERT INTO pastas (nome) VALUES (?)")->execute([$nome]);
}
header("Location: index.php");
