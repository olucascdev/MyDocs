<?php
session_start();
require_once '../vendor/autoload.php'; // Certifique-se de que o autoload do Composer esteja incluído
include_once "../config/Database.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];

    // Certifique-se de que o usuário esteja logado
    if (!isset($_SESSION['id'])) {
        echo "Usuário não está logado!";
        exit();
    }

    $usuario_id = $_SESSION['id']; // Pegue o ID do usuário da sessão
    
    // Inserir a pasta no banco de dados com o usuario_id
    $stmt = $pdo->prepare("INSERT INTO pastas (nome, usuario_id) VALUES (?, ?)");
    $stmt->execute([$nome, $usuario_id]);

    $pasta_id = $pdo->lastInsertId(); // ID da nova pasta inserida

    // Gerar a URL do QR Code para a visualização da pasta
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/MyDocs/pages/visualizar_pasta.php?id=" . $pasta_id;

    // Definir as opções do QR Code (tamanho, erro de correção, etc.)
    $options = new QROptions([
        'version' => 5,
        'ecc'     => QRCode::ECC_L,
        'scale'   => 10,
    ]);

    // Gerar o QR Code
    $qrcode = new QRCode($options);
    $imagem_qrcode = '../uploads/qrcode_pasta_' . $pasta_id . '.png'; // Caminho onde o QR será salvo
    $qrcode->render($url, $imagem_qrcode); // Gerar e salvar o QR Code no diretório 'uploads'

    // Atualizar a pasta no banco de dados com o caminho do QR Code
    $stmt = $pdo->prepare("UPDATE pastas SET qrcode_path = ? WHERE id = ?");
    $stmt->execute([$imagem_qrcode, $pasta_id]);

    // Redirecionar para a página de visualização da pasta
    header("Location: ../gerenciador.php");
    exit();
}
?>
