<?php 
    include_once "../config/Database.php";
    session_start();
    if(isset($_SESSION['id'])) {
        header('Location: ../home.php');
    }
?>


<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>login</title>
</head>
<body class="d-flex aling-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto form-container">
        <form action="../controllers/LoginController.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center ">
                
                
                <h1 class="fw-semibold">Login</h1>

            </div>
            <br>
            <div class="form-floating">
                <input type="text" class="form-control" id="user" name="user" placeholder="Email ou Nickname" required>
                <label for="user" id="user" name="user">usuário:</label>
            </div>
            
            <div class="form-floating">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                <label for="senha">Senha:</label>
            </div>
            <br>
            <input type="submit" class="btn btn-primary w-100 py-2" name="entrar" id="entrar" value="Entrar"></input>
        </form>
    </main>
    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>