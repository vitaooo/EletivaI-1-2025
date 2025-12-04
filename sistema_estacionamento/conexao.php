<?php
    // PDO = PHP DATA OBJECT
    $dominio = "mysql:host=127.0.0.1;dbname=estacionamento_db";
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha);
    } catch (Exception $e) {
        die("Erro ao conectar ao banco!" . $e->getMessage());
    }