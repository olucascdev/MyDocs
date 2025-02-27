<?php
require_once 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer esteja incluído
ini_set('display_errors', 1);
error_reporting(E_ALL);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    
    // Inserir a pasta no banco de dados
    $pdo->prepare("INSERT INTO pastas (nome) VALUES (?)")->execute([$nome]);
    $pasta_id = $pdo->lastInsertId(); // ID da nova pasta inserida

    // Gerar o QR Code com o link para a pasta (pode ser uma URL que leva ao diretório da pasta ou algo único)
    $url = "http://localhost/mydocs/pasta.php?id=" . $pasta_id;

    // Definir as opções do QR Code (tamanho, erro de correção, etc.)
    $options = new QROptions([
        'version' => 5,
        'ecc'     => QRCode::ECC_L,
        'scale'   => 10,
    ]);

    // Gerar o QR Code
    $qrcode = new QRCode($options);
    $imagem_qrcode = 'uploads/qrcode_pasta_' . $pasta_id . '.png'; // Caminho onde o QR será salvo
    $qrcode->render($url, $imagem_qrcode); // Gerar e salvar o QR Code no diretório 'uploads'

    // Atualizar a pasta no banco de dados com o caminho do QR Code
    $pdo->prepare("UPDATE pastas SET qrcode_path = ? WHERE id = ?")
        ->execute([$imagem_qrcode, $pasta_id]);

    // Redirecionar para a página de visualização da pasta
    header("Location: index.php");
    exit();
}
?>