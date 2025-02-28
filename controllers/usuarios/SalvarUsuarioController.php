<?php
include_once '../../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $telefoneFixo = $_POST['telefone_fixo'];
    $telefoneMovel = $_POST['telefone_movel'];
    $observacoes = $_POST['observacoes'];
    $notificacoes = $_POST['notificacoes'];
    $dataExpiracao = $_POST['data_expiracao'];
    $permissao = $_POST['permissao'];
    $estabelecimento = $_POST['estabelecimento'];
    $empresa = $_POST['empresa'];

    // Validação (como exemplo, você pode personalizar conforme necessário)
    if (empty($nome) || empty($usuario) || empty($email)) {
        die("Nome, usuário e e-mail são obrigatórios!");
    }

    // Prepare a consulta para salvar os dados do usuário
    if ($id) {
        // Atualizar um usuário existente
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, usuario = ?, email = ?, telefone_fixo = ?, telefone_movel = ?, observacoes = ?, notificacoes = ?, data_expiracao = ?, acesso = ?, estabelecimento = ?, empresa = ?, uf = ?, cidade = ? WHERE id = ?");
        $stmt->execute([$nome, $usuario, $email, $telefoneFixo, $telefoneMovel, $observacoes, $notificacoes, $dataExpiracao, $permissao, $estabelecimento, $empresa, $uf, $cidade, $id]);
    } else {
        // Inserir um novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, usuario, email, telefone_fixo, telefone_movel, observacoes, notificacoes, data_expiracao, acesso, estabelecimento, empresa, uf, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $usuario, $email, $telefoneFixo, $telefoneMovel, $observacoes, $notificacoes, $dataExpiracao, $permissao, $estabelecimento, $empresa, $uf, $cidade]);
    }

    // Redireciona para a lista de usuários após salvar
    header('Location: ../../pages/TelaUsers.php');
    exit;
}
