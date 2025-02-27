<?php
include_once "../config/Database.php";

$pasta_id = $_GET["id"];

// Buscar a pasta para garantir que existe
$pasta = $pdo->prepare("SELECT * FROM pastas WHERE id = ?");
$pasta->execute([$pasta_id]);
$pasta = $pasta->fetch();

if (!$pasta) {
    echo "Pasta não encontrada!";
    exit;
}

// Gerar a URL do QR Code
$url = "http://" . $_SERVER['HTTP_HOST'] . "/mydocs/pages/visualizar_pasta.php?id=" . $pasta_id;
// Gerar o QR Code com a biblioteca chillerlan/php-qrcode
require '../vendor/autoload.php';
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$options = new QROptions([
    'version' => 5,
    'eccLevel' => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'imageBase64' => false,
]);

$qrcode = new QRCode($options);
$imageData = $qrcode->render($url); // Gerar o QR Code

// Salvar o QR Code em um arquivo temporário
$tempFile = '../uploads/qrcode_' . $pasta_id . '.png';
file_put_contents($tempFile, $imageData);

// Verificar se o arquivo foi salvo corretamente
if (!file_exists($tempFile)) {
    echo "Erro ao salvar o QR Code.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code - <?= $pasta['nome'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/visualizar_qrcode.css"> 
    
</head>
<body>
    <div class="container mt-5 text-center">
        <h2 class="text-primary">QR Code para a pasta: <?= $pasta['nome'] ?></h2>

        <div class="qr-code-container">
            <img src="../uploads/qrcode_<?= $pasta_id ?>.png" alt="QR Code">
        </div>

        <div class="mt-4">
            <a href="../index.php" class="btn btn-secondary">Voltar</a>
            <a href="../uploads/qrcode_<?= $pasta_id ?>.png" download="qrcode_<?= $pasta['nome'] ?>.png" class="btn btn-success btn-lg">Baixar QR Code</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
