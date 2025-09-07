<?php
include("cabecalho.php");

echo "<h1>Exercício 3</h1>";
?>
<form method="post">
<div class="mb-3">
              <label for="fw" class="form-label">Digite uma palavra</label>
              <input type="text" id="fw" name="fw" class="form-control">
            </div><div class="mb-3">
              <label for="sw" class="form-label">Digite outra palavra</label>
              <input type="text" id="sw" name="sw" class="form-control">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $w1 = $_POST['fw'];
    $w2 = $_POST['sw'];

    function acharPalavra($palavra1, $palavra2){
        $tem = strpos($palavra1, $palavra2);
        if($tem == 1){
            echo "<h2>A segunda palavra está dentro da primeira</h2>";
        } else {
            echo "<h2>A segunda palavra não está dentro da primeira</h2>";
        }
    }
    acharPalavra($w1, $w2);
}
include("rodape.php");
?>