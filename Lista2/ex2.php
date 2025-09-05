<?php

include("cabecalho.php");
echo "Exercício 2";
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1></h1>
        <form method="post">
            <div class="mb-3">
                <label for="numero1" class="form-label">Informe um número</label>
                <input type="number" id="numero1" name="numero1" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="numero2" class="form-label"></label>
                <input type="text" id="numero2" name="numero2" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $n1 = $_POST['numero1'];
    $n = $_POST['numero2'];
    $resultado;
    if ($n1 == $n2) {
        $resultado = ($n1 + $n2) * 3;
        echo "<h2>O triplo da soma dos números iguais é $resultado</h2>";
    } else {
        $resultado = $n1 + $n2;
        echo "<h2>O resultado soma dos números é $resultado</h2>";
    }
}

include("rodape.php");
?>