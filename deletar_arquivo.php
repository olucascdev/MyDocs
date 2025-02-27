<?php
$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");
$id = $_GET["id"];
$pasta_id = $_GET["pasta"];

$arquivo = $pdo->prepare("SELECT caminho FROM documentos WHERE id = ?");
$arquivo->execute([$id]);
$arquivo = $arquivo->fetch();

if ($arquivo && file_exists($arquivo["caminho"])) {
    unlink($arquivo["caminho"]);
}

$pdo->prepare("DELETE FROM documentos WHERE id = ?")->execute([$id]);
header("Location: pasta.php?id=$pasta_id");
