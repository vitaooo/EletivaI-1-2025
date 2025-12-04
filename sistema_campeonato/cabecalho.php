<?php
session_start();
if (!isset($_SESSION['acesso']))
    header('location: index.php');
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Campeonato</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="style.css" rel="stylesheet">
</head>

<body class="boody-cab">

    <div class="app-container">
        <nav class="sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="principal.php" class="<?= $pagina_atual == 'principal.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-house"></i> Principal
                    </a>
                </li>
                <li>
                    <a href="campeonato.php" class="<?= $pagina_atual == 'campeonato.php' || $pagina_atual == 'novo_campeonato.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-user"></i> Campeonatos
                    </a>
                </li>
                <li>
                    <a href="times.php" class="<?= $pagina_atual == 'times.php' || $pagina_atual == 'nova_equipe.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-shoe-prints"></i> Times
                    </a>
                </li>
                <li>
                    <a href="partida.php" class="<?= $pagina_atual == 'partida.php' || $pagina_atual == 'nova_partida.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-trophy"></i> Partidas
                    </a>
                </li>
            </ul>
        </nav>

        <main class="main-content">
            <header class="top-header">
                <?php
                if (strpos($pagina_atual, 'campeonato') !== false) echo "Cadastros / Campeonatos";
                elseif (strpos($pagina_atual, 'equipe') !== false) echo "Equipes";
                elseif (strpos($pagina_atual, 'partida') !== false) echo "Partidas";
                elseif (strpos($pagina_atual, 'times') !== false) echo "times";
                else echo "Principal";
                ?>

                <div style="display: flex; align-items: center; gap: 15px;">
                    <h1 class="title-main" style="margin: 0; font-size: 1rem;"><?= $_SESSION['nome'] ?></h1>
                    <h6 class="get-out" style="margin: 0;"><a href="logout.php" style="color: #ffde59;">Sair</a></h6>
                </div>
            </header>