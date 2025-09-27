<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
"<h2>Exercício 5</h2>";

$tam = 1;

?>

<form method="post">
    <div class="mb-3">
        <?php for ($i = 1; $i <= $tam; $i++): ?>
            <div class="row inline-row mb-3">

                <div class="col-md-4">
                    <label for="titulo[<?= $i ?>]" class="form-label">Título do livro: </label>
                    <input type="text" id="titulo[<?= $i ?>]" name="titulo[<?= $i ?>]" class="form-control" required="">
                </div>

                <div class="col-md-4">
                    <label for="quantidade[<?= $i ?>]" class="form-label">Quantidade em estoque: </label>
                    <input type="number" id="quantidade[<?= $i ?>]" name="quantidade[<?= $i ?>]" class="form-control" required="">
                </div>

            </div>

        <?php endfor; ?>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titulos = $_POST['titulo'];
    $qtde = $_POST['quantidade'];


    $mapa_livros = [];

    foreach ($titulos as $i => $titulo) {
    $qtdeB = $qtde[$i];
        if ($qtdeB < 5) {
            echo "<script>alert('Estoque baixo!!');</script>";
        }
            $mapa_livros[$titulo] = $qtdeB;

    ksort($mapa_livros);

    echo "<p>Lista de contato ordenada:</p>";

    foreach ($mapa_livros as $t => $q) {
        echo "<p>Livro: $t - Quantidade em estoque: $q</p>";
    }
}
}
include("rodape.php");
?>