<?php
session_start();
include_once '../../config/Database.php';

// Recebe o valor do parâmetro 'id' da URL e sanitiza
$estabelecimentoId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($estabelecimentoId) {
    try {
        // Verifica se o estabelecimento existe
        $sql = "SELECT * FROM estabelecimentos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $estabelecimentoId, PDO::PARAM_INT);
        $stmt->execute();
        $estabelecimento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($estabelecimento) {
            // Exclui o estabelecimento
            $sqlDelete = "DELETE FROM estabelecimentos WHERE id = :id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $estabelecimentoId, PDO::PARAM_INT);

            if ($stmtDelete->execute()) {
                echo "<script>
                    alert('Estabelecimento excluído com sucesso');
                    window.location.href='../../pages/TelaUnidades.php';
                </script>";
            } else {
                echo "<script>
                    alert('Erro ao excluir o estabelecimento');
                    window.location.href='../../pages/TelaUnidades.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Estabelecimento não encontrado');
                window.location.href='../../pages/TelaUnidades.php';
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Erro: " . addslashes($e->getMessage()) . "');
            window.location.href='../../pages/TelaUnidades.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID inválido');
        window.location.href='../../pages/TelaUnidades.php';
    </script>";
}
?>
