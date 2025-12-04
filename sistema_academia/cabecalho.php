<?php
session_start();
if (!isset($_SESSION['acesso'])) header('location: principal.php');
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Academia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="style.css" rel="stylesheet">
</head>
<body class="body-cab">
    <div class="app-container">
        <nav class="sidebar">
            <div style="padding: 20px; text-align: center; color: white;">
                <h2 style="font-family: 'Bebas Neue'; margin: 0;">EVO <span style="color: #8ecae6;">FIT</span></h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="principal.php" class="<?= $pagina_atual == 'principal.php' ? 'active' : '' ?>"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="alunos.php" class="<?= strpos($pagina_atual, 'aluno') !== false ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Alunos</a></li>
                <li><a href="professores.php" class="<?= strpos($pagina_atual, 'professor') !== false ? 'active' : '' ?>"><i class="fa-solid fa-dumbbell"></i> Professores</a></li>
                <li><a href="planos.php" class="<?= strpos($pagina_atual, 'plano') !== false ? 'active' : '' ?>"><i class="fa-solid fa-file-invoice-dollar"></i> Planos</a></li>
                <li><a href="matriculas.php" class="<?= strpos($pagina_atual, 'matricula') !== false ? 'active' : '' ?>"><i class="fa-solid fa-address-card"></i> Matrículas</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <header class="top-header">
                <span>Gestão Integrada</span>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span style="font-weight: bold;"><?= $_SESSION['nome'] ?></span>
                    <a href="logout.php" style="color: var(--primary-color); font-size: 0.9rem;">Sair <i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </header>
            <div class="content-wrapper">