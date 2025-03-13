<?php 
   include_once "config/Database.php";

   session_start();
   if(!isset($_SESSION['id'])) {
     header('Location: pages/TelaLogin.php');
}

// Consultar a quantidade de pastas
$sql = "SELECT COUNT(*) AS total_pastas FROM pastas";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtendo o total de pastas
$total_pastas = $result['total_pastas'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (for icons in sidebar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <title>MyDocs</title>
</head>
<body>
   <!-- Sidebar -->
  <div class="fixed">
    <div class="sidebar d-flex flex-column p-3">
      <div class="logo text-center mb-4">
        <h3>MyDocs</h3>
      </div>
      <nav>
        <div class="mb-2">
          <a class="parameter-item" target="frame" href="gerenciador.php" role="button" aria-expanded="false" aria-controls="param1Subthemes">
              <i class="bi bi-newspaper"></i> Gerenciador
          </a>
        </div>
        <div class="mb-2">
          <a class="parameter-item" href="pages/TelaUsers.php" target="frame" role="button" aria-expanded="false" aria-controls="param2Subthemes">
            <i class="bi bi-people-fill"></i> Usuários
          </a>
        </div>
        <div class="mb-2">
          <a class="parameter-item"  href="pages/TelaUnidades.php" target="frame" role="button" aria-expanded="false" aria-controls="param3Subthemes">
            <i class="bi bi-building"></i> Unidades
          </a>
      </nav>
      <div class="mt-auto">
        <a href="controllers/LogoutController.php" class="text-center d-block">Logout</a>
      </div>
    </div>
    <!-- Main Content -->
    <div class="main-content">
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
              <i class="bi bi-folder-fill" style="font-size: 1.5rem;"> Minhas Pastas</i> <!-- Ícone maior -->
                <p class="card-text" style="font-size: 2rem;"><?php echo $total_pastas; ?></p>
              </div>
            </div>
        </div>
        

          
        </div>
        <div class="row">
          <div class="col-12">
          <iframe width="100%"  height="547px" frameborder="0" marginheight="0" marginwidth="0" name="frame" scrolling="yes" src="gerenciador.php">

          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="javascript" src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>          
</body>
</html>