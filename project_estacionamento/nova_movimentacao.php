<?php
require("conexao.php");

// 1. Processa Formulário
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $veiculo_id = $_POST['veiculo_id'];
    $vaga_id = $_POST['vaga_id'];
    $data_entrada = date('Y-m-d H:i:s'); // Data atual

    try {
        $pdo->beginTransaction();

        // Insere Movimentação
        $stmt = $pdo->prepare("INSERT INTO movimentacao (veiculo_id, vaga_id, data_entrada) VALUES (?, ?, ?)");
        $stmt->execute([$veiculo_id, $vaga_id, $data_entrada]);

        // Atualiza status da Vaga para OCUPADA
        $stmtVaga = $pdo->prepare("UPDATE vaga SET status = 'OCUPADA' WHERE id = ?");
        $stmtVaga->execute([$vaga_id]);

        $pdo->commit();
        header('location: movimentacao.php?cadastro=true');
        exit;

    } catch(Exception $e) {
        $pdo->rollBack();
        $erro = "Erro ao registrar: " . $e->getMessage();
    }
}

// 2. Busca Veículos e Vagas LIVRES
$veiculos = $pdo->query("SELECT id, placa, modelo FROM veiculo")->fetchAll();
$vagas = $pdo->query("SELECT id, codigo FROM vaga WHERE status = 'LIVRE'")->fetchAll();

require("cabecalho.php");
?>

<div class="header-flex">
    <h2>Registrar Nova Entrada</h2>
</div>

<?php if(isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form method="post" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Selecione o Veículo</label>
        <select name="veiculo_id" class="form-select" required>
            <option value="">Escolha...</option>
            <?php foreach($veiculos as $v): ?>
                <option value="<?= $v['id'] ?>"><?= strtoupper($v['placa']) ?> - <?= $v['modelo'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Selecione a Vaga (Apenas Livres)</label>
        <select name="vaga_id" class="form-select" required>
            <option value="">Escolha...</option>
            <?php foreach($vagas as $vg): ?>
                <option value="<?= $vg['id'] ?>"><?= $vg['codigo'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Registrar Entrada</button>
    <a href="movimentacao.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("footer.php"); ?>