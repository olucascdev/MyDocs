<?php
    include_once "config/Database.php";
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: pages/TelaLogin.php');
        exit();
    }

    // Obter o ID do usuário logado
    $usuario_id = $_SESSION['id'];

    // Consultar a quantidade de pastas do usuário
    $sql = "SELECT COUNT(*) AS total_pastas FROM pastas WHERE usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT); // Vinculando o ID do usuário
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtendo o total de pastas
    $total_pastas = $result['total_pastas'];

    // Consultar a quantidade de documentos do usuário
    $sql_documentos = "SELECT COUNT(*) AS total_documentos FROM documentos WHERE usuario_id = :usuario_id"; // Ajuste o nome da tabela e coluna conforme seu banco
    $stmt_documentos = $pdo->prepare($sql_documentos);
    $stmt_documentos->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT); // Vinculando o ID do usuário
    $stmt_documentos->execute();
    $result_documentos = $stmt_documentos->fetch(PDO::FETCH_ASSOC);
 
    // Obtendo o total de documentos
    $total_documentos = $result_documentos['total_documentos'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="shortcut icon" href="assets/img/icon.svg" type="image/x-icon" size="128x128">
    <title>MyDocs - Dashboard</title>
</head>
<body>
    <!-- Layout Principal -->
    <div class="fixed">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <div class="logo">
                <img src="assets/img/MyDocs.svg" alt="MyDocs Logo">
            </div>
            
            <nav>
                <div class="mb-3">
                    <a class="parameter-item" target="frame" href="gerenciador.php">
                        <i class="bi bi-newspaper"> </i> Gerenciador
                    </a>
                </div>
                <!-- Perguntar se vale a pena essa feature
                <div class="mb-3">
                    <a class="parameter-item" target="frame" href="pages/conversor.php">
                        <i class="bi bi-file-earmark-richtext-fill"></i>Conversor
                    </a>
                </div>
                
                <div class="mb-3">
                    <a class="parameter-item" target="frame" href="#">
                        <i class="bi bi-person-lines-fill"></i>Perfil
                    </a>
                </div>
                 -->

                
                
            </nav>
            <div class="mt-auto">
                <a href="controllers/LogoutController.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>

        </div>
        
        <!-- Conteúdo Principal -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- Cartões de Estatísticas -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-folder-fill"></i>
                                <h5>Minhas Pastas</h5>
                                <p class="card-text"><?php echo $total_pastas; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                <h5>Total de Documentos</h5>
                                <p class="card-text"><?php echo $total_documentos; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Área do iFrame -->
                <div class="row">
                    <div class="col-12">
                        <iframe width="100%" height="547px" frameborder="0" name="frame" src="gerenciador.php"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>