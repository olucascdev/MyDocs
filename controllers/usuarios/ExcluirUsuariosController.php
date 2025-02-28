<?php
session_start();
include_once '../../config/Database.php'; // Caminho para o arquivo de configuração do banco

// Recebe o valor do parâmetro 'id' da URL e sanitiza
$usuarioId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($usuarioId) {
    try {
        // Verifica se o usuário existe
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Exclui o usuário
            $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $usuarioId, PDO::PARAM_INT);

            if ($stmtDelete->execute()) {
                echo "<script>
                    alert('Usuário excluído com sucesso');
                    window.location.href='../../pages/TelaUsers.php'; // Redireciona para a lista de usuários
                </script>";
            } else {
                echo "<script>
                    alert('Erro ao excluir o usuário');
                    window.location.href='../../pages/TelaUsers.php'; // Redireciona para a página de usuários
                </script>";
            }
        } else {
            echo "<script>
                alert('Usuário não encontrado');
                window.location.href='../../pages/TelaUsers.php'; // Redireciona para a página de usuários
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Erro: " . addslashes($e->getMessage()) . "');
            window.location.href='../../pages/TelaUsers.php'; // Redireciona para a página de usuários
        </script>";
    }
} else {
    echo "<script>
        alert('ID inválido');
        window.location.href='../../pages/TelaUsuarios.php'; // Redireciona para a página de usuários
    </script>";
}
?>
