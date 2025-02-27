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

        <ul class="list-group mt-3">
            <?php foreach ($documentos as $doc): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="<?= $doc['caminho'] ?>" download class="text-decoration-none"><?= $doc['nome_arquivo'] ?></a>
                    <a href="deletar_arquivo.php?id=<?= $doc['id'] ?>&pasta=<?= $pasta_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir arquivo?')">Excluir</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
