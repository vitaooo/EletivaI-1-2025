<?php
require("conexao.php");
require("cabecalho.php");

// --- LÓGICA: Buscar Estatísticas ---
try {
    // 1. Total de Vagas
    $total_vagas = $pdo->query("SELECT count(*) FROM vaga")->fetchColumn();

    // 2. Vagas Ocupadas
    $ocupadas = $pdo->query("SELECT count(*) FROM vaga WHERE status = 'OCUPADA'")->fetchColumn();

    // 3. Vagas Livres (Cálculo simples)
    $livres = $total_vagas - $ocupadas;

    // 4. Movimentações (Entradas) de Hoje
    $hoje = $pdo->query("SELECT count(*) FROM movimentacao WHERE DATE(data_entrada) = CURDATE()")->fetchColumn();

} catch (Exception $e) {
    echo "Erro ao carregar dados: " . $e->getMessage();
    $total_vagas = 0; $ocupadas = 0; $livres = 0; $hoje = 0;
}
?>

<div style="margin-top: 20px;">
    <h1 style="margin-bottom: 10px; color: var(--header-dark);">Painel de Controle</h1>
    <p style="margin-bottom: 30px; color: #666;">Visão geral do estacionamento em tempo real.</p>

    <div class="dashboard-grid">
        
        <div class="card-stats card-green">
            <div class="card-info">
                <h3><?= $livres ?></h3>
                <span>Vagas Livres</span>
            </div>
            <div class="card-icon">
                <i class="fa-solid fa-square-parking"></i>
            </div>
        </div>

        <div class="card-stats card-red">
            <div class="card-info">
                <h3><?= $ocupadas ?></h3>
                <span>Ocupadas</span>
            </div>
            <div class="card-icon">
                <i class="fa-solid fa-car-side"></i>
            </div>
        </div>

        <div class="card-stats card-blue">
            <div class="card-info">
                <h3><?= $total_vagas ?></h3>
                <span>Capacidade Total</span>
            </div>
            <div class="card-icon">
                <i class="fa-solid fa-warehouse"></i>
            </div>
        </div>

        <div class="card-stats card-yellow">
            <div class="card-info">
                <h3><?= $hoje ?></h3>
                <span>Entradas Hoje</span>
            </div>
            <div class="card-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid #ccc; margin: 30px 0;">

    <h2 style="margin-bottom: 20px; color: var(--text-dark);">Acesso Rápido</h2>

    <div class="actions-grid">
        <a href="nova_movimentacao.php" class="btn-big-action">
            <i class="fa-solid fa-circle-plus"></i>
            Registrar Entrada
        </a>

        <a href="movimentacao.php" class="btn-big-action">
            <i class="fa-solid fa-list-check"></i>
            Consultar Pátio
        </a>

        <a href="novo_cliente.php" class="btn-big-action">
            <i class="fa-solid fa-user-plus"></i>
            Novo Cliente
        </a>

        <a href="novo_veiculo.php" class="btn-big-action">
            <i class="fa-solid fa-car"></i>
            Novo Veículo
        </a>
    </div>
</div>

<?php require("footer.php"); ?>