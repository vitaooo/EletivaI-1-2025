<?php
require("conexao.php");

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
    $data_saida = date('Y-m-d H:i:s');
    $valor = $_POST['valor_total'];
    $vaga_id = $_POST['vaga_id_real'];

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("UPDATE movimentacao SET data_saida = ?, valor_total = ? WHERE id = ?");
        $stmt->execute([$data_saida, $valor, $id]);

        $stmtVaga = $pdo->prepare("UPDATE vaga SET status = 'LIVRE' WHERE id = ?");
        $stmtVaga->execute([$vaga_id]);

        $pdo->commit();
        header('location: movimentacao.php?saida=true');
        exit;

    } catch(Exception $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}

require("cabecalho.php");
?>

<div class="header-flex">
    <h2>Finalizar Estadia (Saída)</h2>
</div>

<form method="post" style="max-width: 600px;">
    <input type="hidden" name="id" value="<?= $mov['id'] ?>">
    <input type="hidden" name="vaga_id_real" value="<?= $mov['vaga_id_real'] ?>">

    <div class="mb-3">
        <label class="form-label">Veículo / Vaga</label>
        <input type="text" class="form-control" disabled 
               value="<?= strtoupper($mov['placa']) ?> - Vaga <?= $mov['codigo_vaga'] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Data Entrada</label>
        <input type="text" class="form-control" disabled 
               value="<?= date('d/m/Y H:i:s', strtotime($mov['data_entrada'])) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Data Saída (Agora)</label>
        <input type="text" class="form-control" disabled value="<?= date('d/m/Y H:i:s') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Valor Total (R$)</label>
        <input type="number" step="0.01" name="valor_total" class="form-control" required placeholder="0.00">
        <small>Insira o valor a ser cobrado.</small>
    </div>

    <button type="submit" class="btn btn-success">Confirmar Saída e Liberar Vaga</button>
    <a href="movimentacao.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("footer.php"); ?>