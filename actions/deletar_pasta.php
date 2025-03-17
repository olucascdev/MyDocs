<?php
session_start(); // Garantir que a sessão esteja ativa
include_once "../config/Database.php";

$id = $_GET["id"];
$pdo->prepare("DELETE FROM pastas WHERE id = ?")->execute([$id]);
header("Location: ../gerenciador.php");
