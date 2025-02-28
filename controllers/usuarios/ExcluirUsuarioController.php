<?php 
session_start();
include_once '../../config/Database.php';


// Recebe o valor do parâmetro 'id' da URL e sanitiza
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($userId > 0) {
    try {
        // Cria a consulta SQL para recuperar o nome da imagem associada ao usuário
        $sql = "SELECT foto FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Obtém o nome da imagem
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $imagem = $linha['foto'];

            // Define o caminho completo para a imagem
            $caminhoImagem = '../../assets/img' . $imagem;

            // Exclui o registro do banco de dados
            $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmtDelete->execute();

            // Verifica se o arquivo da imagem existe e exclui
            if (!empty($imagem) && file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }

            // Exibe mensagem de sucesso e redireciona
            echo "
                <script>
                    alert('Usuário excluído com sucesso');
                    window.location.href='../../pages/TelaUsers.php';
                </script>
            ";
        } else {
            // Se não encontrar o usuário
            echo "
                <script>
                    alert('Usuário não encontrado');
                    window.location.href='../../pages/TelaUsers.php';
                </script>
            ";
        }
    } catch (PDOException $e) {
        // Se ocorrer um erro
        echo "
            <script>
                alert('Erro ao excluir registro do banco de dados: " . $e->getMessage() . "');
                window.location.href='../../pages/TelaUsers.php';
            </script>
        ";
    }
} else {
    // Se o ID não for válido
    echo "
        <script>
            alert('ID inválido');
            window.location.href='../../pages/TelaUsers.php';
        </script>
    ";
}
?>
