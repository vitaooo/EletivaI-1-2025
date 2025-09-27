<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
"<h2>Exercício 1</h2>";

?>

<form method="post">
    <div class="mb-3">
        <?php for ($i = 1; $i <= 2; $i++): ?>
            <div class="row inline-row mb-3">
                <div class="col-md-6">
                    <label for="nome[<?= $i ?>]" class="form-label">Digite seu nome</label>
                    <input type="text" id="nome[<?= $i ?>]" name="nome[<?= $i ?>]" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="phone[<?= $i ?>]" class="form-label">Digite seu número de telefone</label>
                    <input type="number" id="phone[<?= $i ?>]" name="phone[<?= $i ?>]" class="form-control" required="">
                </div>

            </div>

        <?php endfor; ?>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nome'];
    $numeros = $_POST['phone'];

    $mapa_contatos = [];

    foreach ($nomes as $i => $nome) {
        $numero = $numeros[$i];

        if (!empty($nome) && !empty($numero) && !array_key_exists($nome, $mapa_contatos) && !in_array($numero, $mapa_contatos)) {
            $mapa_contatos[$nome] = $numero;
        }
    }

    ksort($mapa_contatos);

    echo "<p>Lista de contato ordenada:</p>";

    foreach ($mapa_contatos as $nome_final => $telefone_final) {
        echo "<p>$nome_final $telefone_final</p>";
    }
}
include("rodape.php");
?>