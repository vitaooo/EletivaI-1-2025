<?php
require("cabecalho.php");
require("conexao.php");

try{
    $sql = "SELECT * FROM vaga ORDER BY codigo ASC"; 
    $stmt = $pdo->query($sql);
    $vagas = $stmt->fetchAll();
} catch(\Exception $e) {
    echo "<p style='color:red'>Erro: ".$e->getMessage()."</p>";
}
?>

<div class="header-flex">
    <h2>Gestão de Vagas</h2>
    <a href="nova_vaga.php" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Nova Vaga
    </a>
</div>

<table class="styled-table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Status</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($vagas as $v): ?>
            <tr>
                <td style="font-size: 1.1rem; font-weight: bold;"><?= $v['codigo'] ?></td>
                <td>
                    <?php if($v['status'] == 'LIVRE'): ?>
                        <span style="color: green; font-weight: bold; background: #d4edda; padding: 4px 8px; border-radius: 4px;">LIVRE</span>
                    <?php else: ?>
                        <span style="color: #721c24; font-weight: bold; background: #f8d7da; padding: 4px 8px; border-radius: 4px;">OCUPADA</span>
                    <?php endif; ?>
                </td>
                <td style="text-align: center; display: flex; gap: 5px; justify-content: center;">
                    <a href="editar_vaga.php?id=<?= $v['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <!-- Botão Consultar Adicionado -->
                    <a href="consultar_vaga.php?id=<?= $v['id'] ?>" class="btn btn-warning btn-sm">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>