<?php
ob_start(); 
session_start();

if (!isset($_SESSION['acesso'])) {
    header('location: index.php');
    exit;
}
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Safety - Estacionamento</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="main-header">
        <div class="logo-area">
            <h1>Vehicle Safety</h1>
            <span>Estacionamentos</span>
        </div>

        <div class="breadcrumbs">
            HOME > Sistema de Gestão
        </div>

        <nav class="nav-bar">
            <a href="principal.php" class="<?= $pagina_atual == 'principal.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Principal
            </a>
            <a href="clientes.php" class="<?= strpos($pagina_atual, 'cliente') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> Clientes
            </a>
            <a href="veiculos.php" class="<?= strpos($pagina_atual, 'veiculo') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-car"></i> Veículos
            </a>
            <a href="vagas.php" class="<?= strpos($pagina_atual, 'vaga') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-square-parking"></i> Vagas
            </a>
            <a href="movimentacao.php" class="<?= strpos($pagina_atual, 'movimentacao') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-exchange-alt"></i> Movimentações
            </a>

            <div class="user-info">
                <span>Olá, <?= $_SESSION['nome'] ?? 'Usuário' ?></span>
                <a href="logout.php" class="btn-sair"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </div>
        </nav>
    </header>

    <div class="container">