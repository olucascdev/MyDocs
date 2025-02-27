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
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Título -->
        <h2 class="text-primary">Gerenciador de Arquivos</h2>

        <!-- Formulário para criar pasta centralizado -->
        <div class="form-container">
            <form action="criar_pasta.php" method="POST" class="d-flex w-75">
                <input type="text" name="nome" class="form-control me-2" placeholder="Nome da pasta" required>
                <button type="submit" class="btn btn-primary">Criar Pasta</button>
            </form>
        </div>

        <!-- Tabela para exibir as pastas centralizada -->
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
                        <td class="text-center d-flex justify-content-center ">
                            <!-- Botão de Acessar -->
                            <a href="pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-success btn-sm me-2 ">Acessar</a>

                            <!-- Botão de Editar -->
                            <a href="editar_pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-warning btn-sm me-2 ">Editar</a>

                            <!-- Botão de Excluir -->
                            <a href="deletar_pasta.php?id=<?= $pasta['id'] ?>" class="btn btn-danger btn-sm me-2" onclick="return confirm('Excluir pasta?')">Excluir</a>

                            <!-- Botão de Ver QR Code -->
                            <a href="visualizar_qrcode.php?id=<?= $pasta['id'] ?>" class="btn btn-info btn-sm">Ver QR Code</a>
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
