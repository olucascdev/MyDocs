<?php
include_once '../../config/Database.php';


// Inicializa a variável do usuário
$usuario = null;

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o id é válido
    if (is_numeric($id)) {
        // Prepara a consulta SQL para obter o usuário com o ID fornecido
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        
        if (!$usuario) {
            // Se o usuário não for encontrado
            die("Usuário não encontrado.");
        }
    } else {
        die("ID inválido.");
    }
} else {
    die("ID não fornecido.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/editar.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-left mb-4">Editar Usuário</h1>
        
        <!-- Formulário de Edição de Usuário -->
        <form method="POST" action="SalvarUsuarioController.php">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="nome" class="form-label">Nome do Usuário</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome do usuário" required value="<?php echo isset($usuario) ? htmlspecialchars($usuario->nome) : ''; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="permissao" class="form-label">Permissão do Usuário</label>
                    <select class="form-select" id="permissao" name="permissao" required>
                        <option selected disabled value="">Selecione o nível de permissão</option>
                        <option value="0" <?php echo (isset($usuario) && $usuario->acesso == 0) ? 'selected' : ''; ?>>Visitante</option>
                        <option value="1" <?php echo (isset($usuario) && $usuario->acesso == 1) ? 'selected' : ''; ?>>Usuário</option>
                        <option value="2" <?php echo (isset($usuario) && $usuario->acesso == 2) ? 'selected' : ''; ?>>Gestor</option>
                        <option value="3" <?php echo (isset($usuario) && $usuario->acesso == 3) ? 'selected' : ''; ?>>Administrador</option>
                        <option value="4" <?php echo (isset($usuario) && $usuario->acesso == 4) ? 'selected' : ''; ?>>Master</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="estabelecimento" class="form-label">Estabelecimento do Usuário</label>
                    <select class="form-select" id="estabelecimento" name="estabelecimento">
                        <option selected>Não vincular estabelecimento ao usuário</option>
                        <option value="SPT25" <?php echo (isset($usuario) && $usuario->estabelecimento == 'SPT25') ? 'selected' : ''; ?>>SPT25</option>
                        <option value="SPT26" <?php echo (isset($usuario) && $usuario->estabelecimento == 'SPT26') ? 'selected' : ''; ?>>SPT26</option>
                        <option value="SPT32" <?php echo (isset($usuario) && $usuario->estabelecimento == 'SPT32') ? 'selected' : ''; ?>>SPT32</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="empresa" class="form-label">Empresa do Usuário</label>
                    <select class="form-select" id="empresa" name="empresa">
                        <option selected>Não vincular empresa ao usuário</option>
                        <option value="PERBRAS" <?php echo (isset($usuario) && $usuario->empresa == 'PERBRAS') ? 'selected' : ''; ?>>PERBRAS</option>
                    </select>
                </div>
            </div>
            
            <!-- Campos de Login, Email, Telefone, etc. -->
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="usuario" class="form-label">Login do Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Informe o login do usuário" required value="<?php echo isset($usuario) ? htmlspecialchars($usuario->usuario) : ''; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email" class="form-label">E-mail do Usuário</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@usuario.com.br" required value="<?php echo isset($usuario) ? htmlspecialchars($usuario->email) : ''; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="uf" class="form-label">Estado (UF)</label>
                    <select class="form-select" id="uf" name="uf" required>
                        <option value="">Selecione um Estado</option>
                        <?php
                            // Carregar estados dinamicamente
                            $stmt = $conn->prepare('SELECT * FROM estados');
                            $stmt->execute();
                            $estados = $stmt->fetchAll(PDO::FETCH_OBJ);
                            foreach($estados as $estado) {
                                echo "<option value='{$estado->id}'" . (isset($usuario) && $usuario->uf == $estado->id ? ' selected' : '') . ">{$estado->nome}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cidades" class="form-label">Cidade do Usuário</label>
                    <select class="form-select" id="cidades" name="cidade">
                        <option>Selecione o Estado primeiro</option>
                    </select>
                </div>
            </div>

            <!-- Campos de Telefone e Observações -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="telefone-fixo" class="form-label">Telefone Fixo</label>
                    <input type="tel" class="form-control" id="telefone-fixo" name="telefone_fixo" placeholder="(00) 0000-0000" value="<?php echo htmlspecialchars($usuario->telefone_fixo ?? ''); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="telefone-movel" class="form-label">Telefone Móvel</label>
                    <input type="tel" class="form-control" id="telefone-movel" name="telefone_movel" placeholder="(00) 00000-0000" value="<?php echo htmlspecialchars($usuario->telefone_movel ?? ''); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="observacoes" class="form-label">Observações sobre o Usuário</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="2" placeholder="Informe observações se necessário"><?php echo htmlspecialchars($usuario->observacoes ?? ''); ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="notificacoes" class="form-label">Enviar Notificações por E-mail</label>
                    <select class="form-select" id="notificacoes" name="notificacoes">
                        <option value="sim" <?php echo (isset($usuario) && $usuario->notificacoes == 'sim') ? 'selected' : ''; ?>>Sim, enviar e-mails de notificações</option>
                        <option value="nao" <?php echo (isset($usuario) && $usuario->notificacoes == 'nao') ? 'selected' : ''; ?>>Não enviar e-mails de notificações</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="data-expiracao" class="form-label">Acesso do Usuário Expira em</label>
                    <input type="date" class="form-control" id="data-expiracao" name="data_expiracao" value="<?php echo htmlspecialchars($usuario->data_expiracao ?? ''); ?>">
                </div>
            </div>

            <!-- Botões -->
            <div class="d-flex">
                <button type="submit" class="btn btn-primary  p-3 m-2 w-25">Salvar Usuário</button>
                <a href="Users.php"><button type="button" class="btn btn-danger  p-3 m-2 w-100">Cancelar</button></a>
            </div>
        </form>
    </div>               

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
