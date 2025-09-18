<?php
    $nome = "Victor";

    echo "<p>Todas em maiúsculo :".strtoupper($nome)."</p>";
    echo "<p>Todas em minúsculo :".strtolower($nome)."</p>";
    echo "<p>Qtde de caracteres :".strlen($nome)."</p>";
    $posicao = strpos($nome, "t");
    echo "<p>Caractere I na posição $posicao</p>";
    date_default_timezone_set('America/Sao_Paulo');

    $data1 = date("d/m/Y");
    echo "<p>$data1</p>";
    $hora = date("H:i:s");
    echo "<p>$hora</p>";
    if(checkdate(2, 30, 2025)){
        echo "<p>A data informada existe (30/02/2025</p>";
    } else {
        echo "<p>A data informada não existe (30/02/2025)</p>";
    }

    $valor = 10;
    echo "<p>Valor absoluto:".abs($valor)."</p>";
    $valor = 5.9;
    echo "<p>Valor Arredondado:".round($valor)."</p>";
    $valor = rand(1, 100);
    echo "<p>Valor aleatório: $valor</p>";
    echo "<p>Raiz quadrada de 16: ".sqrt(16)."</p>";
    $valor = 13.5;
    echo "<p>Valor formatado: ".number_format($valor, 2, ",", ".")."</p>";

    function exibirSaudacao(){
        echo "<h1>Olá Mundo!</h1>";
    }

    exibirSaudacao();

    function exibirSaudacaoComNome($nome){
        echo "<h1>Seja bem vindo $nome !</h1>";
    }

    exibirSaudacaoComNome("Victor");

    function menorValor($valor1, $valor2){
        return min($valor1, $valor2);
    }

    echo "<h2>Menor valor entre 4 e 8:".menorValor(8,4)."</h2>";

    function somarValores(...$numeros){
        return array_sum($numeros);
    }

    $soma = somarValores(1,2,3,4,5,6,);
    echo "<h2>A soma dos valores é: $soma</h2>"

?>