<?php
// Conectar ao banco de dados
include_once '../../config/Database.php';


// Função para salvar ou editar o usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? 0;
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'] ?: 'guardiao123'; // Caso a senha não seja alterada
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $acesso = $_POST['acesso'];
    $ativo = $_POST['ativo'];
    $unidadePrincipal = $_POST['unidadePrincipal'];
    $unidadeAssistente = $_POST['unidadeAssistente'];

    if ($id) {
        // Editar usuário
        $stmt = $pdo->prepare("UPDATE usuarios SET usuario = ?, senha = ?, nome = ?, email = ?, acesso = ?, ativo = ?, unidadePrincipal = ?, unidadeAssistente = ? WHERE id = ?");
        $stmt->execute([$usuario, $senha, $nome, $email, $acesso, $ativo, $unidadePrincipal, $unidadeAssistente, $id]);
        header("Location: ../../pages/TelaUsers.php?id=$id"); // Redireciona para o mesmo formulário
    } else {
        // Criar novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, nome, email, acesso, ativo, unidadePrincipal, unidadeAssistente, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$usuario, $senha, $nome, $email, $acesso, $ativo, $unidadePrincipal, $unidadeAssistente]);
        header("Location: ../../pages/TelaUsers.php"); // Redireciona para o formulário em branco
    }
}

