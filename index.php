<?php
$pdo = new PDO("mysql:host=localhost;dbname=mydocs", "root", "");
$pastas = $pdo->query("SELECT * FROM pastas ORDER BY criado_em DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Arquivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary text-center">Gerenciador de Arquivos</h2>

        <form action="criar_pasta.php" method="POST" class="mt-3 d-flex">
            <input type="text" name="nome" class="form-control me-2" placeholder="Nome da pasta" required>
            <button type="submit" class="btn btn-primary">Criar Pasta</button>
        </form>

        <ul class="list-group mt-3">
            <?php foreach ($pastas as $pasta): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="pasta.php?id=<?= $pasta['id'] ?>" class="text-decoration-none"><?= $pasta['nome'] ?></a>
                    <a href="deletar_pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir pasta?')">Excluir</a>
                    <!-- Adicionando o botão para ver o QR Code -->
                    <a href="visualizar_qrcode.php?id=<?= $pasta['id'] ?>" class="btn btn-info btn-sm">Ver QR Code</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
