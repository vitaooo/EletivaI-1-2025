<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
"<h2>Exercício 4</h2>";

$tam = 1;

?>

<form method="post">
    <div class="mb-3">
        <?php for ($i = 1; $i <= $tam; $i++): ?>
            <div class="row inline-row mb-3">
            
                <div class="col-md-4">
                    <label for="nome[<?= $i ?>]" class="form-label">Nome do produto: </label>
                    <input type="text" id="nome[<?= $i ?>]" name="nome[<?= $i ?>]" class="form-control" required="">
                </div>

                <div class="col-md-4">
                    <label for="preco[<?= $i ?>]" class="form-label">Preço: </label>
                    <input type="number" id="preco[<?= $i ?>]" name="preco[<?= $i ?>]" class="form-control" required="">
                </div>

            </div>

        <?php endfor; ?>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomes = $_POST['nome'];
    (double)$precos = $_POST['preco'];


    $mapa_produtos = [];
    foreach($nomes as $i => $nome) {
        $preco = (float)$precos[$i];   
        $preco = $preco + ($preco * 0.15);

        $mapa_produtos[$nome] = $preco;
    }


    asort($mapa_produtos);


    /*usort($mapa_produtos, function ($a, $b) {
        return $a['preco'] <=> $b['preco'];
    });*/

    echo "<p>Lista de contato ordenada:</p>";

    foreach($mapa_produtos as $a => $b) {
        echo "<p>$a $b</p>";
    }


}
include("rodape.php");
?>