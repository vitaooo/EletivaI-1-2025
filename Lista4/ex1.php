<?php
include("cabecalho.php");

echo "<h1>Lista 4</h1>",
    "<h2>Exercício 1</h2>";
?>

<form method="post">
<div class="mb-3">
        <?php for($i=1;$i<=2;$i++): ?>
              <label for="nome[<?=$i?>]" class="form-label">Digite seu nome:</label>
              <input type="text" id="nome[<?=$i?>]" name="nome[<?=$i?>]" class="form-control" required="">
            </div><div class="mb-3">
              <label for="phone[<?=$i?>]" class="form-label">Digite seu número de telefone</label>
              <input type="number" id="phone[<?=$i?>]" name="phone[<?=$i?>]" class="form-control" required="">
            <?php endfor; ?>
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $numero = $_POST['phone'];

    for($i=1;$i<=2;$i++){
        $telefonica = [
        $nome[$i] => $numero[$i]
    ];
        for($i;$i<2;$i++){
            if($nome[$i] == $nome[$j] AND $numero[$j] == $numero[$i]){
                echo "<p>Tem duplicata!</p>";
            }
        }

    foreach($telefonica as $n => $t){
    echo "<p>$n $t</p>";
}
}

    
    
}

include("rodape.php");
?>