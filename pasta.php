<?php
include_once "config/Database.php";

$pasta_id = $_GET["id"];

// Pega a pasta
$pasta = $pdo->prepare("SELECT * FROM pastas WHERE id = ?");
$pasta->execute([$pasta_id]);
$pasta = $pasta->fetch();

// Configuração de paginação
$itens_por_pagina = 2; 
$pagina_atual = $_GET['pagina'] ?? 1; 
$inicio = ($pagina_atual - 1) * $itens_por_pagina;

// Conta o total de documentos da pasta específica
$total_documentos = $pdo->prepare("SELECT COUNT(*) FROM documentos WHERE pasta_id = ?");
$total_documentos->execute([$pasta_id]);
$total_documentos = $total_documentos->fetchColumn();

$total_paginas = ceil($total_documentos / $itens_por_pagina);

// Busca os documentos com LIMIT e OFFSET
$documentos = $pdo->prepare("SELECT * FROM documentos WHERE pasta_id = ? LIMIT $inicio, $itens_por_pagina");
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
    <link rel="stylesheet" href="assets/css/pasta.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary text-center"><?= $pasta['nome'] ?></h2>

        <div class="form-container text-center mb-4">
            <a href="gerenciador.php" class="btn btn-secondary">Voltar</a>
            <form action="actions/upload.php" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center w-75">
                <input type="hidden" name="pasta_id" value="<?= $pasta_id ?>">
                <input type="file" name="arquivo" class="form-control me-2" required>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
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
                            <div>
                                <a href="uploads/<?= $documento['nome_arquivo'] ?>" download class="btn btn-success btn-sm ms-2">Baixar</a>
                                <a href="uploads/<?= $documento['nome_arquivo'] ?>" target="_blank" class="btn btn-primary btn-sm ms-2">Acessar</a>
                                <a href="actions/deletar_arquivo.php?id=<?= $documento['id'] ?>&pasta=<?= $pasta_id ?>" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($pagina_atual == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $pasta_id ?>&pagina=<?= $pagina_atual - 1 ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= ($pagina_atual == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $pasta_id ?>&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pagina_atual == $total_paginas) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $pasta_id ?>&pagina=<?= $pagina_atual + 1 ?>">Próximo</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
