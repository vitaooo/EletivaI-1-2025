<?php
require("conexao.php");

$vaga = null;
$erro_msg = null;

// 1. Lógica de Exclusão (POST)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    try {
        // Verifica se a vaga está ocupada antes de excluir
        $check = $pdo->prepare("SELECT status FROM vaga WHERE id = ?");
        $check->execute([$id]);
        $v = $check->fetch();

        if ($v && $v['status'] == 'OCUPADA') {
            $erro_msg = "Não é possível excluir uma vaga que está OCUPADA. Libere-a primeiro.";
        } else {
            $stmt = $pdo->prepare("DELETE FROM vaga WHERE id = ?");
            if ($stmt->execute([$id])) {
                header('location: vagas.php?excluir=true');
                exit;
            }
        }
    } catch (\Exception $e) {
        $erro_msg = "Erro ao excluir: Possivelmente existem registros de histórico vinculados a esta vaga.";
    }
}

// 2. Busca Dados (GET)
$id_busca = $_GET['id'] ?? $_POST['id'] ?? null;
if ($id_busca) {
    $stmt = $pdo->prepare("SELECT * FROM vaga WHERE id = ?");
    $stmt->execute([$id_busca]);
    $vaga = $stmt->fetch(PDO::FETCH_ASSOC);
}

require("cabecalho.php");
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Vaga</h1>

    <?php if ($erro_msg): ?>
        <div class="alert alert-danger"><?= $erro_msg ?></div>
    <?php endif; ?>

    <?php if($vaga): ?>
    <form method="post" style="max-width: 500px; background: white; padding: 20px; border-radius: 8px;">
        <input type="hidden" name="id" value="<?= $vaga['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input disabled value="<?= $vaga['codigo'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Status Atual</label>
            <input disabled value="<?= $vaga['status'] ?>" class="form-control" 
                   style="color: <?= $vaga['status']=='LIVRE' ? 'green' : 'red' ?>; font-weight: bold;">
        </div>

        <div class="alert alert-warning">
            Deseja excluir esta vaga permanentemente?
        </div>
        
        <button type="submit" class="btn btn-danger">Excluir Vaga</button>
        <a href="vagas.php" class="btn btn-secondary">Voltar</a>
    </form>
    <?php else: ?>
        <div class="alert alert-danger">Vaga não encontrada.</div>
        <a href="vagas.php" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>
</div>

<?php require("footer.php"); ?>