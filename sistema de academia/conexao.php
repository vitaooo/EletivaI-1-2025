<?php
    $dominio = "mysql:host=127.0.0.1;dbname=academiaphp";
    $usuario = "root";
    $senha = ""; 

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erro ao conectar ao banco! " . $e->getMessage());
    }
?>