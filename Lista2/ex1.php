<?php
include("cabecalho.php");

echo "<h1>Exercício 1</h1>";
?>

<form method="post">
    <div>
        <label for="n1" class="form-label">Número 1:</label>
        <input type="number" id="n1" class="form-control" name="n1">
    </div>
    <div>
        <label for="n2" class="form-label">Número 2:</label>
        <input type="number" id="n2" class="form-control" name="n2">
    </div>
    <div>
        <label for="n3" class="form-label">Número 3:</label>
        <input type="number" id="n3" class="form-control" name="n3">
    </div>
    <div>
        <label for="n4" class="form-label">Número 4:</label>
        <input type="number" id="n4" class="form-control" name="n4">
    </div>
    <div>
        <label for="n5" class="form-label">Número 5:</label>
        <input type="number" id="n5" class="form-control" name="n5">
    </div>
    <div>
        <label for="n6" class="form-label">Número 6:</label>
        <input type="number" id="n6" class="form-control" name="n6">
    </div>
    <div>
        <label for="n7" class="form-label">Número 7:</label>
        <input type="number" id="n7" class="form-control" name="n7">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $n1 = $_POST['n1'];
    $n2 = $_POST['n2'];
    $n3 = $_POST['n3'];
    $n4 = $_POST['n4'];
    $n5 = $_POST['n5'];
    $n6 = $_POST['n6'];
    $n7 = $_POST['n7'];
    $menor = $n1;
    $posicao = 1;

    if ($n2 < $menor) {
        $menor = $n2;
        $posicao = 2;
    }

    if ($n3 < $menor) {
        $menor = $n3;
        $posicao = 3;
    }

    if ($n4 < $menor) {
        $menor = $n4;
        $posicao = 4;
    }

    if ($n5 < $menor) {
        $menor = $n5;
        $posicao = 5;
    }

    if ($n6 < $menor) {
        $menor = $n6;
        $posicao = 6;
    }

    if ($n7 < $menor) {
        $menor = $n7;
        $posicao = 7;
    }

    echo "<p>O menor número é $menor e está na posição $posicao </p>";
    
    include("rodape.php");
}
