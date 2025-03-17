<?php
include_once "../config/Database.php";
session_start(); // Garantir que a sessão esteja ativa

// Verifique se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/TelaLogin.php"); // Redirecionar para a tela de login caso não esteja logado
    exit();
}

$pasta_id = $_POST["pasta_id"];
$arquivo = $_FILES["arquivo"];
$usuario_id = $_SESSION['id']; // Recuperar o ID do usuário da sessão

if ($arquivo["error"] == UPLOAD_ERR_OK) {
    $nomeArquivo = basename($arquivo["name"]);
    $caminho = "../uploads/" . $nomeArquivo;

    // Criar a pasta uploads caso não exista
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    // Mover o arquivo para a pasta uploads
    if (move_uploaded_file($arquivo["tmp_name"], $caminho)) {
        // Salvar no banco de dados, incluindo o usuario_id
        $stmt = $pdo->prepare("INSERT INTO documentos (pasta_id, nome_arquivo, caminho, usuario_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$pasta_id, $nomeArquivo, $caminho, $usuario_id])) {
            echo "Arquivo enviado com sucesso!";
        } else {
            echo "Erro ao salvar no banco de dados.";
        }
    } else {
        echo "Erro ao mover o arquivo para a pasta uploads.";
    }
} else {
    echo "Erro no upload: " . $arquivo["error"];
}

header("Location: ../pasta.php?id=$pasta_id");
exit();
