<?php
include_once "../config/Database.php";

$pasta_id = $_GET['id'];

// Buscar a pasta para garantir que existe
$pasta = $pdo->prepare("SELECT * FROM pastas WHERE id = ?");
$pasta->execute([$pasta_id]);
$pasta = $pasta->fetch();

if (!$pasta) {
    echo "Pasta não encontrada!";
    exit;
}

// Lógica para atualizar o nome da pasta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'];

    // Atualizar o nome da pasta no banco de dados
    $stmt = $pdo->prepare("UPDATE pastas SET nome = ? WHERE id = ?");
    $stmt->execute([$novo_nome, $pasta_id]);

    echo "Pasta atualizada com sucesso!";
    header("Location: ../gerenciador.php"); // Redireciona para a página principal
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Pasta</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary text-center">Editar Pasta</h2>

        <br>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>

        <!-- Formulário de Edição -->
        <form action="editar_pasta.php?id=<?= $pasta_id ?>" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nome" class="form-label">Novo Nome da Pasta</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $pasta['nome'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
