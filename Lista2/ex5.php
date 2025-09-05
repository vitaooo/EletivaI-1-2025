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
        <h1></h1>
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
        switch($numero){
            case 1:
                echo "<p>Janeiro</p>";
                break;
            case 2:
                echo "<p>Fevereiro</p>";
                break;
            case 3:
                echo "<p>Março</p>";
                break;
            case 4:
                echo "<p>Abril</p>";
                break;
            case 5:
                echo "<p>Maio</p>";
                break;
            case 6:
                echo "<p>Junho</p>";
                break;
            case 7:
                echo "<p>Julho</p>";
                break;
            case 8:
                echo "<p>Agosto</p>";
                break;
            case 9:
                echo "<p>Setembro</p>";
                break;
            case 10:
                echo "<p>Outubro</p>";
                break;
            case 11:
                echo "<p>Novembro</p>";
                break;
            case 12:
                echo "<p>Dezembro</p>";
                break;
            default:
                echo "<p>Esse número não corresponde a nenhum mês!</p>";
        }

    }


include("rodape.php");
