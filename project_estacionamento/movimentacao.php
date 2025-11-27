<?php
require("conexao.php");
require("cabecalho.php");

try {
    $sql = "SELECT m.*, v.placa, v.modelo, vg.codigo as codigo_vaga 
            FROM movimentacao m 
            INNER JOIN veiculo v ON m.veiculo_id = v.id 
            INNER JOIN vaga vg ON m.vaga_id = vg.id 
            ORDER BY m.data_entrada DESC";
    $stmt = $pdo->query($sql);
    $movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<div class="header-flex">
    <h2>Fluxo de Movimentações</h2>
    <a href="nova_movimentacao.php" class="btn btn-success">
        <i class="fa-solid fa-car-side"></i> Registrar Entrada
    </a>
</div>

<?php if(isset($_GET['saida']) && $_GET['saida'] == 'true'): ?>
    <div class="alert alert-success" style="margin-top:10px; padding: 10px; background: #d4edda; color: green; border-radius: 5px;">
        Saída registrada com sucesso! Vaga liberada.
    </div>
<?php endif; ?>

<table class="styled-table">
    <thead>
        <tr>
            <th>Veículo</th>
            <th>Vaga</th>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Valor</th>
            <th>Status</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($movimentacoes as $m): ?>
            <?php 
                $em_aberto = empty($m['data_saida']); 
            ?>
            <tr>
                <td>
                    <strong><?= strtoupper($m['placa']) ?></strong><br>
                    <small><?= $m['modelo'] ?></small>
                </td>
                <td><span style="font-weight:bold;"><?= $m['codigo_vaga'] ?></span></td>
                <td><?= date('d/m/Y H:i', strtotime($m['data_entrada'])) ?></td>
                <td>
                    <?= $em_aberto ? '--' : date('d/m/Y H:i', strtotime($m['data_saida'])) ?>
                </td>
                <td>
                    <?= $em_aberto ? '--' : 'R$ ' . number_format($m['valor_total'], 2, ',', '.') ?>
                </td>
                <td>
                    <?php if($em_aberto): ?>
                        <span style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold;">EM ABERTO</span>
                    <?php else: ?>
                        <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold;">CONCLUÍDO</span>
                    <?php endif; ?>
                </td>
                <td style="text-align: center;">
                    <?php if($em_aberto): ?>
                        <a href="editar_movimentacao.php?id=<?= $m['id'] ?>" class="btn btn-primary btn-sm" title="Registrar Saída">
                            <i class="fa-solid fa-flag-checkered"></i> Saída
                        </a>
                    <?php endif; ?>
                    
                    <a href="consultar_movimentacao.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm" title="Ver Detalhes">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>