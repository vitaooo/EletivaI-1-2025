<?php
require("cabecalho.php");
require("conexao.php");

$mov = null;

if(isset($_GET['id'])){
    $sql = "SELECT m.*, v.placa, vg.codigo as codigo_vaga, vg.id as vaga_id_real 
            FROM movimentacao m 
            INNER JOIN veiculo v ON m.veiculo_id = v.id 
            INNER JOIN vaga vg ON m.vaga_id = vg.id 
            WHERE m.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $mov = $stmt->fetch(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $vaga_id = $_POST['vaga_id_real'];
    $data_saida = $_POST['data_saida_atual'];

    try {
        $pdo->beginTransaction();

        $pdo->prepare("DELETE FROM movimentacao WHERE id = ?")->execute([$id]);

        if(empty($data_saida)){
            $pdo->prepare("UPDATE vaga SET status = 'LIVRE' WHERE id = ?")->execute([$vaga_id]);
        }

        $pdo->commit();
        header('location: movimentacao.php?excluir=true');
        exit;
    } catch(Exception $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}
?>

<div class="header-flex">
    <h2>Consultar Detalhes da Movimentação</h2>
</div>

<?php if($mov): ?>
<form method="post" style="max-width: 600px;">
    <input type="hidden" name="id" value="<?= $mov['id'] ?>">
    <input type="hidden" name="vaga_id_real" value="<?= $mov['vaga_id_real'] ?>">
    <input type="hidden" name="data_saida_atual" value="<?= $mov['data_saida'] ?>">

    <div class="mb-3">
        <label class="form-label">Veículo</label>
        <input disabled value="<?= $mov['placa'] ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Vaga</label>
        <input disabled value="<?= $mov['codigo_vaga'] ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Entrada</label>
        <input disabled value="<?= date('d/m/Y H:i', strtotime($mov['data_entrada'])) ?>" class="form-control">
    </div>

    <div class="alert alert-warning">
        Deseja excluir este registro de histórico? 
        <?php if(!$mov['data_saida']): ?>
            <br><strong>Atenção:</strong> O veículo ainda consta estacionado. Excluir este registro liberará a vaga automaticamente.
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-danger">Excluir Registro</button>
    <a href="movimentacao.php" class="btn btn-secondary">Voltar</a>
</form>
<?php else: ?>
    <div class="alert alert-danger">Registro não encontrado.</div>
<?php endif; ?>

<?php require("footer.php"); ?>