<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('',1);

session_start();
include_once "../config/Database.php";

$usuarioId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
$acesso = filter_input(INPUT_GET, 'acesso', FILTER_VALIDATE_INT);  // Se necessário, pode manter FILTER_SANITIZE_STRING aqui
$status = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);
$unidadePrincipal = filter_input(INPUT_GET, 'unidadePrincipal', FILTER_SANITIZE_NUMBER_INT);
$unidadeAssistente = filter_input(INPUT_GET, 'unidadeAssistente', FILTER_SANITIZE_NUMBER_INT);

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="path_to_your_styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-primary">Editar Usuário</h2>

        <!-- Formulário para editar o usuário -->
        <form action="../controllers/usuarios/EditarUsuariosController.php?action=edit" method="POST">
            <!-- Campo oculto para o ID do usuário -->
            <input type="hidden" name="id" value="<?php echo $usuarioId; ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="mb-3">
                <label for="acesso" class="form-label">Acesso</label>
                <input type="text" name="acesso" id="acesso" class="form-control" value="<?php echo htmlspecialchars($acesso); ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>>Ativo</option>
                    <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="unidadePrincipal" class="form-label">Unidade Principal</label>
                <input type="number" class="form-control" id="unidadePrincipal" name="unidadePrincipal" value="<?php echo $unidadePrincipal; ?>" required>
            </div>

            <div class="mb-3">
                <label for="unidadeAssistente" class="form-label">Unidade Assistente</label>
                <input type="number" class="form-control" id="unidadeAssistente" name="unidadeAssistente" value="<?php echo $unidadeAssistente; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="TelaUsers.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
