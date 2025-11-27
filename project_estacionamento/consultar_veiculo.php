<?php
require("cabecalho.php");
require("conexao.php");

$veiculo = null;

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])){
    $sql = "SELECT v.*, c.nome as nome_cliente 
            FROM veiculo v 
            INNER JOIN cliente c ON v.cliente_id = c.id
            WHERE v.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])){
    $id = $_POST['id'];
    try{
        $stmt = $pdo->prepare("DELETE FROM veiculo WHERE id = ?");
        if($stmt->execute([$id])){
            header('location: veiculos.php?excluir=true');
            exit; 
        }
    }catch(\Exception $e){
        echo "Erro ao excluir: ".$e->getMessage();
    }
}
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Veículo</h1>

    <?php if ($veiculo): ?>
        <form method="post" style="background: white; padding: 20px; border-radius: 8px;">
            <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">

            <div class="mb-3">
                <label class="form-label">Placa</label>
                <input disabled value="<?= $veiculo['placa'] ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input disabled value="<?= $veiculo['modelo'] ?> - <?= $veiculo['cor'] ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Proprietário</label>
                <input disabled value="<?= $veiculo['nome_cliente'] ?>" class="form-control">
            </div>

            <div class="alert alert-warning">
                Deseja realmente excluir este veículo?
            </div>
            
            <button type="submit" class="btn btn-danger">Excluir Veículo</button>
            <a href="veiculos.php" class="btn btn-secondary">Voltar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Veículo não encontrado.</div>
    <?php endif; ?>
</div>

<?php require("footer.php"); ?>