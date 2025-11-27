<?php
require("cabecalho.php");
require("conexao.php");

try {
    $sql = "SELECT v.*, c.nome as nome_cliente 
            FROM veiculo v 
            INNER JOIN cliente c ON v.cliente_id = c.id
            ORDER BY v.id DESC";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<div class="header-flex">
    <h2>Gestão de Veículos</h2>
    <a href="novo_veiculo.php" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Novo Veículo
    </a>
</div>

<table class="styled-table">
    <thead>
        <tr> 
            <th>Placa</th>
            <th>Modelo</th>
            <th>Cor</th>
            <th>Proprietário</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d): ?>
            <tr>
                <td style="text-transform: uppercase; font-weight: bold;"><?= $d['placa'] ?></td>
                <td><?= $d['modelo'] ?></td>
                <td><?= $d['cor'] ?></td>
                <td><?= $d['nome_cliente'] ?></td>
                <td style="text-align: center; display: flex; gap: 5px; justify-content: center;">
                    <a href="editar_veiculo.php?id=<?= $d['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="consultar_veiculo.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>