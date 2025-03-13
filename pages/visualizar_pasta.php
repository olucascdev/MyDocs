<!--só o cliente final vai visualizar isso-->

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

// Buscar os documentos dentro da pasta
$documentos = $pdo->prepare("SELECT * FROM documentos WHERE pasta_id = ?");
$documentos->execute([$pasta_id]);
$documentos = $documentos->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pasta['nome'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/visualizar_pasta.css">
</head>
<body>
    <div class="container py-3">
        <div class="pasta-header">
            <i class="fas fa-folder-open folder-icon"></i>
            <h2 class="pasta-title"><?= $pasta['nome'] ?></h2>
        </div>
        
        <div class="documents-list">
            <?php if (empty($documentos)): ?>
                <div class="empty-state">
                    <p>Nenhum documento encontrado nesta pasta.</p>
                </div>
            <?php else: ?>
                <?php foreach ($documentos as $documento): ?>
                    <a href="../uploads/<?= $documento['nome_arquivo'] ?>" target="_blank" class="document-button">
                        <i class="fas fa-file-alt"></i>
                        <span><?= $documento['nome_arquivo'] ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>