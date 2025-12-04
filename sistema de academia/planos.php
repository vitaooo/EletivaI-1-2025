<?php
require("cabecalho.php");
require("conexao.php");

// Busca todos os planos
$dados = $pdo->query("SELECT * FROM plano ORDER BY valor ASC")->fetchAll();
?>

<div class="header-flex">
    <h2 style="color: var(--primary-dark);">Planos Disponíveis</h2>
    <a href="novo_plano.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Novo Plano</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'sucesso'): ?>
        <div class="alert" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Plano criado com sucesso!
        </div>
    <?php elseif ($_GET['msg'] == 'editado'): ?>
        <div class="alert" style="background: #cce5ff; color: #004085; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Plano atualizado!
        </div>
    <?php elseif ($_GET['msg'] == 'excluido'): ?>
        <div class="alert" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Plano excluído.
        </div>
    <?php endif; ?>
<?php endif; ?>

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Plano</th>
            <th>Valor Mensal</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><strong><?= $d['nome'] ?></strong></td>
                <td style="color: green; font-weight: bold;">R$ <?= number_format($d['valor'], 2, ',', '.') ?></td>
                <td style="text-align: center;">
                    <a href="editar_plano.php?id=<?= $d['id'] ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-pen"></i> Editar
                    </a>
                    <a href="consultar_plano.php?id=<?= $d['id'] ?>" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-eye"></i> Consultar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>