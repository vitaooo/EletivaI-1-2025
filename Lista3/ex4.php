<?php
include("cabecalho.php");

echo "<h1>Exercício 4</h1>";
?>
<form method="post">
<div class="mb-3">
              <label for="day" class="form-label">Digite um número referente a um dia <b>(número válido)</b></label>
              <input type="number" id="day" name="day" class="form-control">
            </div>

            <div class="mb-3">
              <label for="mounth" class="form-label">Digite um número referente a um mês <b>(número válido)</b></label>
              <input type="number" id="mounth" name="mounth" class="form-control">
            </div>

            <div class="mb-3">
              <label for="year" class="form-label">Digite um número referente a um ano <b>(número válido)</b></label>
              <input type="number" id="year" name="year" class="form-control">
            </div>

<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $d = $_POST['day'];
    $m = $_POST['mounth'];
    $y = $_POST['year'];

    function validarEApresentarDia($number1, $number2, $number3){


        if($number1 <= 30 && $number2 <= 12  && $number3 > 1930){
        $timestamp = strtotime("$number1-$number2-$number3");

        echo date('d/m/Y', $timestamp);

        } else {
            echo "<p>Data inválida!</p>";
            echo "<p>Digite outra data</p>";
        }
    }
    validarEApresentarDia($d, $m, $y);
}
include("rodape.php");
?>