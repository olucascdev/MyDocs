<?php
    include_once "../config/Database.php";
    session_start();
    if(isset($_SESSION['id'])) {
        header('Location: ../home.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login - MyDocs</title>
</head>
<body>
    <div class="background-wave"></div>
    
    <div class="container">
    
        <div class="login-container">
           
            <div class="login-header">
                <div class="logo-container">
                    <img src="../assets/img/icon.svg" alt="MyDocs icon">
                </div>
                <h1 class="app-title">MyDocs</h1>
                <p class="app-subtitle">Acesse seus documentos</p>
            </div>
            
            <div class="login-form-wrapper">
                <form action="../controllers/LoginController.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Email ou Nickname" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-login" name="entrar" id="entrar">
                            Entrar <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
            

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>