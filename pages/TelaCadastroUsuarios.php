<?php
// Conectar ao banco de dados
include_once '../../config/Database.php';


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$usuario = '';
$nome = '';
$email = '';
$acesso = '';
$ativo = 1;
$unidadePrincipal = '';
$unidadeAssistente = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuarioData = $stmt->fetch();
    
    if ($usuarioData) {
        $usuario = $usuarioData['usuario'];
        $nome = $usuarioData['nome'];
        $email = $usuarioData['email'];
        $acesso = $usuarioData['acesso'];
        $ativo = $usuarioData['ativo'];
        $unidadePrincipal = $usuarioData['unidadePrincipal'];
        $unidadeAssistente = $usuarioData['unidadeAssistente'];
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary text-center">Cadastro de Usuário</h2>

        <form action="../controllers/usuarios/CrudUsuariosController.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $usuario ?>" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" value="guardiao123" required>
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>

            <div class="mb-3">
                <label for="acesso" class="form-label">Acesso</label>
                <input type="number" class="form-control" id="acesso" name="acesso" value="<?= $acesso ?>" required>
            </div>

            <div class="mb-3">
                <label for="ativo" class="form-label">Ativo</label>
                <select class="form-control" id="ativo" name="ativo">
                    <option value="1" <?= $ativo == 1 ? 'selected' : '' ?>>Ativo</option>
                    <option value="0" <?= $ativo == 0 ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="unidadePrincipal" class="form-label">Unidade Principal</label>
                <input type="text" class="form-control" id="unidadePrincipal" name="unidadePrincipal" value="<?= $unidadePrincipal ?>" required>
            </div>

            <div class="mb-3">
                <label for="unidadeAssistente" class="form-label">Unidade Assistente</label>
                <input type="text" class="form-control" id="unidadeAssistente" name="unidadeAssistente" value="<?= $unidadeAssistente ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
