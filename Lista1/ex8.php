<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1></h1>
<form method="post">
<div class="mb-3">
              <label for="l" class="form-label">Digite a largura: </label>
              <input type="number" id="l" name="l" class="form-control">
            </div><div class="mb-3">
              <label for="a" class="form-label">Digite a altura: </label>
              <input type="number" id="a" name="a" class="form-control">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>

</form>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $l = $_POST['l'];
    $a = $_POST['a'];
    
    $area = $l * $a;
    echo "<p> A área é de $area m²</p>";
    
    
  }
  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>