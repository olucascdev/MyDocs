<?php
include_once "config/Database.php";

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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Título da Pasta -->
        <h2 class="text-primary text-center"><?= $pasta['nome'] ?></h2>

        <!-- Botão de Voltar -->
        

        <!-- Formulário para Upload de Documento -->
        <div class="form-container text-center mb-4">
        <div class="text-center mb-3">
            <a href="gerenciador.php" class="btn btn-secondary">Voltar</a>
        </div>
            <form action="actions/upload.php" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center w-75">
                <input type="hidden" name="pasta_id" value="<?= $pasta_id ?>">
                <input type="file" name="arquivo" class="form-control me-2" required>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>

        <!-- Tabela de Documentos -->
        <div class="table-container">
            <table class="table table-light table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome do Documento</th>
                        <th style="width: 30%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documentos as $documento): ?>
                    <tr>
                        <td><?= $documento['nome_arquivo'] ?></td>
                        <td class="text-center">
                            <!-- Botões de Ação -->
                            <div>
                                <!-- Baixar Documento -->
                                <a href="uploads/<?= $documento['nome_arquivo'] ?>" download class="btn btn-success btn-sm ms-2">Baixar</a>

                                <!-- Acessar Documento -->
                                <a href="uploads/<?= $documento['nome_arquivo'] ?>" target="_blank" class="btn btn-primary btn-sm ms-2">Acessar</a>

                                <!-- Deletar Documento -->
                                <a href="actions/deletar_arquivo.php?id=<?= $documento['id'] ?>&pasta=<?= $pasta_id ?>" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
