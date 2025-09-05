<?php

include("cabecalho.php");
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
        <h1>Exercício 9 php</h1>
        <form method="post">
            <div class="mb-3">
                <label for="numero" class="form-label">Informe um número</label>
                <input type="number" id="numero" name="numero" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $numero = $_POST['numero'];
        $fatorial = $numero;
        for($i = $numero -1; $i>1; $i--){
            $fatorial = $fatorial * $i;
        }
    echo "O fatorial do número $numero é $fatorial !";
    }


include("rodape.php");
