<?php

include("cabecalho.php");

    echo "Exercício 3";
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1></h1>
<form method="post">
<div class="mb-3">
              <label for="numeroa" class="form-label">Informe um número</label>
              <input type="number" id="numeroa" name="numeroa" class="form-control" required="">
            </div><div class="mb-3">
              <label for="numerob" class="form-label"></label>
              <input type="text" id="numerob" name="numerob" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $na = $_POST['numeroa'];
    $nb = $_POST['numerob'];

    if($na < $nb){
        for($i = $na; $i <= $nb; $i++){
            echo "<h2>$i</h2>";
        }
    } else if($na > $nb){
        for($i = $nb; $i <= $na; $i++){
            echo "<h2>$i</h2>";
        }
    } else {
        echo "<h2>Números iguais: $na</h2>";
    }

    }

include("rodape.php");
?>