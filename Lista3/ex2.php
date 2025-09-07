<?php
include("cabecalho.php");

echo "<h1>Exercício 2</h1>";
?>
<h1></h1>
<form method="post">
    <div class="mb-3">
        <label for="word" class="form-label">Digite uma palavra</label>
        <input type="text" id="word" name="word" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $word = $_POST['word'];
    function maiuminu($palavra)
    {
        $maiu = strtoupper($palavra);
        $minu = strtolower($palavra);
        echo "$maiu - $minu";
    }
    maiuminu($word);
}



include("rodape.php");
?>