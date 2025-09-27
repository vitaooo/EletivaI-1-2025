<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
"<h2>Exercício 3</h2>";

$tam = 2;

?>

<form method="post">
    <div class="mb-3">
        <?php for ($i = 1; $i <= $tam; $i++): ?>
            <div class="row inline-row mb-3">
                <div class="col-md-12">
                    <label for="codigo[<?= $i ?>]" class="form-label">Código do produto: </label>
                    <input type="text" id="codigo[<?= $i ?>]" name="codigo[<?= $i ?>]" class="form-control">
                </div>

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

    $codigos = $_POST['codigo'];
    $nomes = $_POST['nome'];
    (double)$precos = $_POST['preco'];


    $mapa_produtos = [];
    foreach($codigos as $i => $codigo) {
        $nome = $nomes[$i];
        $preco = (float)$precos[$i];

        if($preco >= 100){
            $preco = $preco - ($preco * 0.1);
        }

        $mapa_produtos[$codigo] = [
            'nome' => $nome,
            'preco' => $preco
        ];
    }

    uasort($mapa_produtos, function ($a, $b) {
        return $a['nome'] <=> $b['nome'];
    });

    echo "<p>Lista de contato ordenada:</p>";

    foreach($mapa_produtos as $codigo => $dados_produto) {
        $preco_formatado = number_format($dados_produto['preco'], 2, ',', '.');
        
        echo "<p>Código: {$codigo} | Nome: {$dados_produto['nome']} | Preço: R$ {$preco_formatado}</p>";
    }


}
include("rodape.php");
?>