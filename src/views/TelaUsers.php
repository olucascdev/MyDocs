<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="/projetos/MyDocs/public/css/Users.css">
</head>

<body>

  <!-- Seção de lista de Users cadastrados -->
  <div class="container2">
    <div class="row">
      <div class="col m-5">
        <h2>Painel de Usuários</h2>
      </div>
    </div>
    <!-- Seção de Pesquisa -->
    <div class="box-search w-auto">
      <a href="#"><button class="btn btn-success"><i class="bi bi-person-plus-fill"></i> Novo
          Usuário</button></a>
      <button class="btn btn-warning"><i class="bi bi-printer-fill"></i> Imprimir</button>
      <button type="button" class="btn btn-info" onclick="atualizarPagina()">
        <i class="bi bi-arrow-clockwise"></i> Atualizar
      </button>
      <input type="search" class="form-control w-50" placeholder="Pesquisar por Cód / Email / Nome" id="pesquisar">
      <button class="btn btn-primary" onclick="searchData()"><i class="bi bi-search"></i></button>
    </div>

    <!-- Tabela para exibir Users cadastrados -->
    <table class="table table-light table-bordered table-striped table-hover m-5" border="1" cellspacing=0
      cellpadding=10>
      <thead>
        <tr>
          <th style="width: 5%">Código</th>
          <th style="width: 30%">Nome do usuário</th>
          <th style="width: 15%">Acesso</th>
          <th style="width: 30%">E-mail</th>
          <th style="width: 10%">Status</th>
          <th style="width: 15%">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($users) && !empty($users)) { ?>
        <?php foreach ($users as $item) {  ?>
        <tr>
          <td><?php echo $item['id']; ?></td>
          <td><?php echo $item['nome']; ?></td>
          <td>
            <?php
                switch ($item['acesso']) {
                  case '0':
                    echo 'Visitante';
                    break;
                  case '1':
                    echo 'Usuário';
                    break;
                  case '2':
                    echo 'Gestor';
                    break;
                  case '3':
                    echo 'Administrador';
                    break;
                  case '4':
                    echo 'Master';
                    break;
                }
                ?>
          </td>
          <td><?php echo $item['email']; ?></td>
          <td class="text-center">
            <?php
                switch ($item['ativo']) {
                  case '0':
                    echo 'Desativado';
                    break;
                  default:
                    echo 'Ativo';
                    break;
                }
                ?>
          </td>
          <td class="text-center d-flex justify-content-center">
            <a class="btn btn-danger btn-sm me-2" href="Controller/excluir.php?id=<?php echo $item['id']; ?>"><i
                class="bi bi-trash-fill w-25"></i>
            </a>
          </td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td colspan="6" class="text-center">Nenhum usuário encontrado.</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!--script para pesquisa-->
  <script>
  var search = document.getElementById('pesquisar');
  search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      searchData();
    }
  });

  function searchData() {
    window.location = 'Users.php?search=' + search.value;
  }
  </script>
  <!--script para atualizar pagina e resetar a pesquisa-->
  <script>
  function atualizarPagina() {
    // Limpa o campo de pesquisa
    document.getElementById('pesquisar').value = '';

    // Remove qualquer parâmetro de busca da URL e recarrega a página
    const urlSemParametros = window.location.href.split('?')[0];
    window.location.href = urlSemParametros;
  }

  // Função de pesquisa (se já estiver implementada)
  function searchData() {
    const query = document.getElementById('pesquisar').value;
    if (query) {
      // Redireciona para a página com o parâmetro de busca
      window.location.href = `?search=${query}`;
    }
  }
  </script>
</body>

</html>