<?php
    // mapas ordenados
    $valor = array(1, 2, 3, 4, 5);
    echo "<p>Primeiro valor do vetor ". $valor[0] ."</p>";
    //$v = $_POST['nome'];
    $i = 0;
    $vetor = [1, 2, 3, 4, 5];
    // função para exibir valores do vetor
    var_dump($vetor);
    echo "<br/>";
    echo " ";
    print_r($vetor);

    $vetor[4] = 6;
    echo "<p>Novo valor da posição 4: ".$vetor[4]."</p>";

    $vetor['nome'] = "Victor";
    print_r($vetor);
    echo "<p>".$vetor['nome']."</p>";

    $valores = [
        'nome' => 'Victor',
        'sobrenome' => 'Verçosa',
        'idade' => 35
    ];

    foreach($valores as $c => $v){
        echo "<p>Posição: $c => $v </p>";
    }