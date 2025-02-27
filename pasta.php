<?php
$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");
$pasta_id = $_GET["id"];
$pasta = $pdo->prepare("SELECT * FROM pastas WHERE id = ?");
$pasta->execute([$pasta_id]);
$pasta = $pasta->fetch();

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
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary"><?= $pasta['nome'] ?></h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <form action="upload.php" method="POST" enctype="multipart/form-data" class="d-flex">
            <input type="hidden" name="pasta_id" value="<?= $pasta_id ?>">
            <input type="file" name="arquivo" class="form-control me-2" required>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <!-- Lista de documentos -->
        <ul class="list-group mt-3">
            <?php foreach ($documentos as $documento): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?= $documento['nome_arquivo'] ?></span>

                    <!-- Botões de Ação -->
                    <div>
                        
                        <!-- Baixar Documento -->
                        <a href="uploads/<?= $documento['nome_arquivo'] ?>" download class="btn btn-success btn-sm ms-2">Baixar</a>

                        <!-- Acessar Documento -->
                        <a href="uploads/<?= $documento['nome_arquivo'] ?>" target="_blank" class="btn btn-primary btn-sm ms-2">Acessar</a>

                        <!-- Deletar Documento -->
                        <a href="deletar_arquivo.php?id=<?= $documento['id'] ?>&pasta=<?= $pasta_id ?>" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')">Excluir</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
