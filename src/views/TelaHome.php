<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons (for icons in sidebar) -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <!-- O css do arquivo pode dar algum problema ao subir no servidor, verificar dpois-->
  <?php $base_url = "/projetos/MyDocs/public"; ?>
  <link rel="stylesheet" href="<?= $base_url ?>/css/Style.css">
  <title><?php echo $title; ?></title>
</head>



<body>
  <!-- Sidebar -->
  <div class="fixed">
    <div class="sidebar d-flex flex-column p-3">
      <div class="logo text-center mb-4">
        <h3>📄MyDocs</h3>
      </div>
      <nav>
        <div class="mb-2">
          <a class="parameter-item" target="frame" href="#" role="button" aria-expanded="false"
            aria-controls="param1Subthemes">
            <i class="bi bi-newspaper"></i> Documentos
          </a>
        </div>
        <div class="mb-2">
          <a class="parameter-item" href="http://localhost/projetos/MyDocs/users" target="frame" role="button"
            aria-expanded="false" aria-controls="param2Subthemes">
            <i class="bi bi-people-fill"></i> Usuários
          </a>
        </div>
        <div class="mb-2">
          <a class="parameter-item" href="http://localhost/projetos/MyDocs/unidades" target="frame" role="button"
            aria-expanded="false" aria-controls="param3Subthemes">
            <i class="bi bi-building"></i> Unidades
          </a>
        </div>
      </nav>
      <div class="mt-auto">
        <a href="#" class="text-center d-block"><i class="bi bi-power"></i> Logout</a>
      </div>
    </div>
    <!-- Main Content -->
    <div class="main-content">
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                1 QRCODE ATIVO
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                Card 2 Content
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                Card 3 Content
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-12">
            <iframe width="100%" height="547px" frameborder="0" marginheight="0" marginwidth="0" name="frame"
              scrolling="yes" src="#">

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>