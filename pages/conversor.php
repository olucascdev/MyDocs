<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Converter</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/conversor.css">
</head>
<body>
  <div class="container">
    <div class="card p-4">
      <h2 class="text-center card-title mb-4">Conversor online de documento</h2>
      <p class="text-center text-light">Converta arquivos de qualquer formato online</p>

      <div class="upload-section" id="uploadSection">
        <input type="file" id="fileInput" class="form-control mb-3">
        <button class="btn btn-primary w-100" onclick="showConverter()">Selecionar arquivo</button>
      </div>

      <div class="convert-section d-none" id="convertSection">
        <div class="file-info mb-3">Arquivo: <span id="fileName"></span></div>
        <select class="form-select mb-3">
          <option value="pdf">PDF</option>
          <option value="jpg">JPG</option>
          <option value="png">PNG</option>
          <option value="docx">DOCX</option>
          <option value="txt">TXT</option>
        </select>
        <button class="btn btn-primary w-100">Converter</button>
      </div>
    </div>
  </div>

  <script>
    function showConverter() {
      const fileInput = document.getElementById('fileInput');
      const fileName = fileInput.files[0]?.name || 'Nenhum arquivo selecionado';
      document.getElementById('fileName').innerText = fileName;
      document.getElementById('uploadSection').classList.add('d-none');
      document.getElementById('convertSection').classList.remove('d-none');
    }
  </script>

</body>
</html>