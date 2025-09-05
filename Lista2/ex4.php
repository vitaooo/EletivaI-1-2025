<?php
include("cabecalho.php");
echo "Exercício 4";
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
              <label for="valorproduto" class="form-label">Digite o valor do produto</label>
              <input type="number" id="valorproduto" name="valorproduto" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $preco = $_POST['valorproduto'];
        if($preco > 100){
            $preco = $preco - ((15 / 100) * $preco);
            echo "<h2>Novo preço do produto é: $preco</h2>";
        } else {
            echo "<h2>O preço do produto é $preco</h2>";
        }
    }
include("rodape.php");
?>