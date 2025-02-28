<?php
include_once '../../config/Database.php';

// Recebe os dados do formulário com sanitização
$usuarioId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$acesso = filter_input(INPUT_POST, 'acesso', FILTER_SANITIZE_NUMBER_INT);  // Se necessário, pode ser alterado para o tipo correto
$status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
$unidadePrincipal = filter_input(INPUT_POST, 'unidadePrincipal', FILTER_SANITIZE_NUMBER_INT);
$unidadeAssistente = filter_input(INPUT_POST, 'unidadeAssistente', FILTER_SANITIZE_NUMBER_INT);

try {
    if (empty($usuarioId)) {
        // Caso o ID não seja fornecido, será um novo cadastro (não aplicável para edição, mas pode ser útil em outras operações)
        throw new Exception('ID do usuário não fornecido!');
    } else {
        // Atualiza o usuário existente
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, acesso = :acesso, ativo = :status, 
                unidadePrincipal = :unidadePrincipal, unidadeAssistente = :unidadeAssistente WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':acesso', $acesso, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':unidadePrincipal', $unidadePrincipal, PDO::PARAM_INT);
        $stmt->bindParam(':unidadeAssistente', $unidadeAssistente, PDO::PARAM_INT);
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);

        $stmt->execute();

        // Caso a atualização seja bem-sucedida
        echo "<script>
                alert('Usuário atualizado com sucesso!');
                window.location.href = '../../pages/TelaUsers.php';  // Redireciona para a tela de usuários
            </script>";
    }
} catch (PDOException $e) {
    // Caso haja um erro no banco de dados
    echo "<script>
            alert('Erro no banco de dados: " . addslashes($e->getMessage()) . "');
            window.location.href = '../../pages/TelaUsers.php';  // Redireciona para a tela de usuários
        </script>";
} catch (Exception $e) {
    // Caso haja outro tipo de erro
    echo "<script>
            alert('Erro: " . addslashes($e->getMessage()) . "');
            window.location.href = '../../pages/TelaUsers.php';
        </script>";
}
?>
