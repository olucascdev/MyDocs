<?php
include_once "config/Database.php";

// Configuração de paginação
$itens_por_pagina = 2; // Definindo quantos itens por página
$pagina_atual = $_GET['pagina'] ?? 1; // Se não tiver o parâmetro de página, define como 1

// Consultando o total de pastas
$total_pastas = $pdo->query("SELECT COUNT(*) FROM pastas")->fetchColumn(); 
$total_paginas = ceil($total_pastas / $itens_por_pagina); // Calculando o total de páginas
$inicio = ($pagina_atual - 1) * $itens_por_pagina; // Calculando o índice de início

// Selecionando as pastas para a página atual
$pastas = $pdo->query("SELECT * FROM pastas ORDER BY criado_em DESC LIMIT $inicio, $itens_por_pagina")->fetchAll();
?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Arquivos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary">Gerenciador de Arquivos</h2>

        <div class="form-container">
            <form action="actions/criar_pasta.php" method="POST" class="d-flex w-75">
                <input type="text" name="nome" class="form-control me-2" placeholder="Nome da pasta" required>
                <button type="submit" class="btn btn-primary">Criar Pasta</button>
            </form>
        </div>

        <!-- Tabela para exibir as pastas -->
        <div class="table-container">
            <table class="table table-light table-bordered table-striped table-hover" border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th style="width: 30%">Nome da Pasta</th>
                        <th style="width: 10%">Data de Criação</th>
                        <th style="width: 15%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pastas as $pasta): ?>
                    <tr>
                        <td><?php echo $pasta['nome']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($pasta['criado_em'])); ?></td>
                        <td class="text-center d-flex justify-content-center">
                            <a href="pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-success btn-sm me-2">Acessar</a>
                            <a href="pages/visualizar_qrcode.php?id=<?= $pasta['id'] ?>" class="btn btn-info btn-sm">Ver QR Code</a>
                            <a href="actions/editar_pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-warning btn-sm me-2">Editar</a>
                            <a href="actions/deletar_pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-danger btn-sm me-2" onclick="return confirm('Excluir pasta?')">Excluir</a>
                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($pagina_atual == 1) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?pagina=<?php echo $pagina_atual - 1; ?>">Anterior</a>
                </li>
                <?php for($i = 1; $i <= $total_paginas; $i++) : ?>
                <li class="page-item <?php if($pagina_atual == $i) echo 'active'; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($pagina_atual == $total_paginas) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?pagina=<?php echo $pagina_atual + 1; ?>">Próximo</a>
                </li>
            </ul>
        </nav>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
