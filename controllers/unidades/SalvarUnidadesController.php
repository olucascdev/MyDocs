<?php
include_once '../../config/Database.php';

// Recebe os dados do formulário com sanitização
$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);
$nome_estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_SPECIAL_CHARS);
$abrev = filter_input(INPUT_POST, 'abrev', FILTER_SANITIZE_SPECIAL_CHARS);
$ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_NUMBER_INT); // Assumindo que o ativo será 0 ou 1

try {
    if (empty($codigo)) {
        // Inserção de novo estabelecimento incluindo 'cadastrado'
        $sql = "INSERT INTO estabelecimentos (estabelecimento, abrev, ativo, cadastrado) 
                VALUES (:estabelecimento, :abrev, :ativo, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':estabelecimento', $nome_estabelecimento);
        $stmt->bindParam(':abrev', $abrev);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt->execute();
    
        echo "Estabelecimento registrado com sucesso!";
    } else {
        // Atualização de estabelecimento existente
        $sql = "UPDATE estabelecimentos SET estabelecimento = :estabelecimento, abrev = :abrev, ativo = :ativo WHERE id = :codigo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':estabelecimento', $nome_estabelecimento);
        $stmt->bindParam(':abrev', $abrev);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();

        echo "Estabelecimento atualizado com sucesso!";
    }

    // Redireciona após o sucesso
    header("Location: ../../pages/TelaUnidades.php");
    exit;

} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>
