<?php
    // PDO = PHP DATA OBJECT
    $dominio = "mysql:host=localhost;dbname=projetoVictor";
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        die("Erro ao conectar ao banco!" . $e->getMessage());
    }