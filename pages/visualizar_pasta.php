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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <h2 class="text-primary"><?= $pasta['nome'] ?></h2>

        <!-- Exibindo os documentos da pasta como links -->
        <div class="d-flex flex-wrap justify-content-center mt-4">
            <?php foreach ($documentos as $documento): ?>
                <a href="uploads/<?= $documento['nome_arquivo'] ?>" target="_blank" class="btn btn-info btn-lg m-2">
                    <?= $documento['nome_arquivo'] ?>
                </a>
               
            <?php endforeach; ?>
        </div>
       
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
