<?php
include_once "../config/Database.php";

$pasta_id = $_POST["pasta_id"];
$arquivo = $_FILES["arquivo"];

if ($arquivo["error"] == UPLOAD_ERR_OK) {
    $nomeArquivo = basename($arquivo["name"]);
    $caminho = "../uploads/" . $nomeArquivo;

    // Criar a pasta uploads caso não exista
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    // Mover o arquivo para a pasta uploads
    if (move_uploaded_file($arquivo["tmp_name"], $caminho)) {
        // Salvar no banco de dados
        $stmt = $pdo->prepare("INSERT INTO documentos (pasta_id, nome_arquivo, caminho) VALUES (?, ?, ?)");
        if ($stmt->execute([$pasta_id, $nomeArquivo, $caminho])) {
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
