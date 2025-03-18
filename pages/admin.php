<?php
    include_once "../config/Database.php";
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['acesso'] != 4) {
        header('Location: TelaLogin.php');
        exit();
    }

    // Consultar a quantidade de usuários
    $sql_usuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
    $stmt_usuarios = $pdo->prepare($sql_usuarios);
    $stmt_usuarios->execute();
    $result_usuarios = $stmt_usuarios->fetch(PDO::FETCH_ASSOC);
    $total_usuarios = $result_usuarios['total_usuarios'];

    // Consultar a quantidade de unidades 
    $sql_unidades = "SELECT COUNT(*) AS total_unidades FROM estabelecimentos";
    $stmt_unidades = $pdo->prepare($sql_unidades);
    $stmt_unidades->execute();
    $result_unidades = $stmt_unidades->fetch(PDO::FETCH_ASSOC);
    $total_unidades = $result_unidades['total_unidades'];

    // Consultar a quantidade de documentos
    $sql_documentos = "SELECT COUNT(*) AS total_documentos FROM documentos";
    $stmt_documentos = $pdo->prepare($sql_documentos);
    $stmt_documentos->execute();
    $result_documentos = $stmt_documentos->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../assets/css/home.css">
    <title>Admin - MyDocs</title>
</head>
<body>
    <div class="fixed">
        <div class="sidebar d-flex flex-column p-3">
            <div class="logo">
                <img src="../assets/img/MyDocs.svg" alt="MyDocs Logo">
            </div>
            <nav>
                <div class="mb-3">
                    <a class="parameter-item" target="frame" href="../gerenciador.php">
                        <i class="bi bi-newspaper"></i> Gerenciador
                    </a>
                </div>
                <div class="mb-3">
                    <a class="parameter-item" href="TelaUsers.php" target="frame">
                        <i class="bi bi-people-fill"></i> Usuários
                    </a>
                </div>
                <div class="mb-3">
                    <a class="parameter-item" href="TelaUnidades.php" target="frame">
                        <i class="bi bi-building"></i> Unidades
                    </a>
                </div>
            </nav>
            <div class="mt-auto">
                <a href="../controllers/LogoutController.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-person-fill"></i>
                                <h5>Total de Usuários</h5>
                                <p class="card-text"><?= $total_usuarios ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-bank2"></i>
                                <h5>Total de Unidades</h5>
                                <p class="card-text"><?= $total_unidades ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                <h5>Total de Documentos</h5>
                                <p class="card-text"><?= $total_documentos ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <iframe width="100%" height="547px" frameborder="0" name="frame" src="../gerenciador.php"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
