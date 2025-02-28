<?php
session_start();
// Caminho ajustado para incluir o arquivo de conexão
require_once '../config/Database.php';
// Agora $pdo está disponível do arquivo Database.php


if(isset($_POST['entrar']) && !empty($_POST['user']) && !empty($_POST['senha'])){
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    
    try {
        if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
            // Se for um email, busque pelo campo 'email'
            $sql = "SELECT * FROM usuarios WHERE email = :user AND senha = :senha";
        } else {
            // Caso contrário, busque pelo 'usuario'
            $sql = "SELECT * FROM usuarios WHERE usuario = :user AND senha = :senha";
        }
        
        // Preparar a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        
        // Verificar se encontrou algum usuário
        if($stmt->rowCount() < 1) {
            // Caso não exista
            unset($_SESSION['user']);
            unset($_SESSION['senha']);
            header('Location: ../controllers/TelaLogin.php');
            exit(); // Importante para interromper a execução
        } else {
            // Caso exista
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $linha['id'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['acesso'] = $linha['acesso'];
            $_SESSION['user'] = $user;
            $_SESSION['senha'] = $senha;
            header('Location: ../home.php');
            exit(); // Importante para interromper a execução
        }
    } catch(PDOException $e) {
        // Exibir erro de forma mais detalhada (remova isso em produção)
        echo 'Erro na consulta: ' . $e->getMessage();
        // Ou registre o erro em um arquivo de log em vez de exibir
        // error_log('Erro no login: ' . $e->getMessage(), 0);
    }
}
?>