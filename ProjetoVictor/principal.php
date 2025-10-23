<?php

    require("cabecalho.php");
?>
        <h1>Seja bem vindo(a) <?= $_SESSION['nome']?>
        <h3>Placa: <?= $_SESSION['placa'] ?></h3>
        <h6><a href="logout.php">Sair</a></h6>

<?php
    require("rodape.php");
?>
   