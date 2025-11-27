<?php
ob_start(); // <--- LINHA NOVA: Previne erro de cabeçalho
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
    
    <style>
        /* Estilos baseados na imagem e reset básico */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body {
            background-color: #E6E2D3; /* Cor bege do fundo da imagem */
            color: #333;
        }

        /* Estilo da parte VERDE (Cabeçalho) */
        header.main-header {
            background-color: #638374; /* Tom de verde da imagem */
            color: white;
            padding: 10px 20px;
            border-bottom: 4px solid #4a6356;
        }

        .logo-area h1 {
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            display: inline-block;
            margin-bottom: 5px;
        }
        
        .logo-area span {
            font-size: 0.8rem;
            display: block;
        }

        .breadcrumbs {
            margin-top: 10px;
            font-weight: bold;
            font-size: 1.1rem;
            color: #2f3d36;
        }

        /* Navegação Horizontal Integrada */
        .nav-bar {
            margin-top: 15px;
            display: flex;
            gap: 15px;
            align-items: center;
            background: rgba(0,0,0,0.1);
            padding: 8px;
            border-radius: 4px;
        }

        .nav-bar a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background 0.3s;
        }

        .nav-bar a:hover, .nav-bar a.active {
            background-color: #4a6356;
        }

        .user-info {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
        }

        .btn-sair {
            color: #ffde59;
            text-decoration: none;
            font-weight: bold;
        }

        /* Container principal */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Estilos de Tabela para o Principal */
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        .table th, .table td { padding: 12px; border: 1px solid #ccc; text-align: left; }
        .table th { background-color: #638374; color: white; }
        .btn { padding: 8px 15px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; display: inline-block;}
        .btn-secondary { background-color: #555; color: white; }
        .text-success { color: green; font-weight: bold; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="logo-area">
            <h1>Vehicle Safety</h1>
            <span>Estacionamentos</span>
        </div>

        <div class="breadcrumbs">
            HOME > Visitantes > Funcionarios
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