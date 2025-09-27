<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
"<h2>Exercício 2</h2>";

$tam = 2;

?>

<form method="post">
    <div class="mb-3">
        <?php for ($i = 1; $i <= $tam; $i++): ?>
            <div class="row inline-row mb-3">
                <div class="col-md-12">
                    <label for="nome[<?= $i ?>]" class="form-label">Digite seu nome</label>
                    <input type="text" id="nome[<?= $i ?>]" name="nome[<?= $i ?>]" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="nota1[<?= $i ?>]" class="form-label">Digite sua nota</label>
                    <input type="number" id="nota1[<?= $i ?>]" name="nota1[<?= $i ?>]" class="form-control" required="">
                </div>

                <div class="col-md-4">
                    <label for="nota2[<?= $i ?>]" class="form-label">Digite sua nota</label>
                    <input type="number" id="nota2[<?= $i ?>]" name="nota2[<?= $i ?>]" class="form-control" required="">
                </div>

                <div class="col-md-4">
                    <label for="nota3[<?= $i ?>]" class="form-label">Digite sua nota</label>
                    <input type="number" id="nota3[<?= $i ?>]" name="nota3[<?= $i ?>]" class="form-control" required="">
                </div>

            </div>

        <?php endfor; ?>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomes = $_POST['nome'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];


    $mapa_notas = [];

    foreach($nomes as $i => $nome) {
        $soma = $nota1[$i] + $nota2[$i] + $nota3[$i];
        $media = $soma / 3;

        $mapa_notas[$nome] = $media;
    }

    arsort($mapa_notas);

    echo "<p>Lista de contato ordenada:</p>";

    foreach($mapa_notas as $nome_final => $media) {
        echo "<p>$nome_final $media</p>";
    }


}
include("rodape.php");
?>