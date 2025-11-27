<?php
    require("conexao.php");

    // 1. Se for GET, busca os dados do veículo para preencher o form
    if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])){
        $stmt = $pdo->prepare("SELECT * FROM veiculo WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 2. Se for POST, atualiza os dados
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $placa = strtoupper($_POST['placa']);
        $modelo = $_POST['modelo'];
        $cor = $_POST['cor'];
        $cliente_id = $_POST['cliente_id'];
        
        try{
            $sql = "UPDATE veiculo SET placa=?, modelo=?, cor=?, cliente_id=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            
            if($stmt->execute([$placa, $modelo, $cor, $cliente_id, $id])){
                header('location: veiculos.php?editar=true');
                exit();
            }
        } catch(PDOException $e){
            $erro = "Erro ao atualizar: " . $e->getMessage();
        }
    }

    // Busca clientes para o select
    $clientes = $pdo->query("SELECT id, nome FROM cliente")->fetchAll();

    require("cabecalho.php"); 
?>

<?php if(isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<h2 style="color: black;">Editar Veículo</h2>

<?php if(isset($veiculo) || isset($_POST['id'])): 
    // Garante que temos dados (seja do banco ou do post anterior se deu erro)
    $val_id = $veiculo['id'] ?? $_POST['id'];
    $val_placa = $veiculo['placa'] ?? $_POST['placa'];
    $val_modelo = $veiculo['modelo'] ?? $_POST['modelo'];
    $val_cor = $veiculo['cor'] ?? $_POST['cor'];
    $val_cli = $veiculo['cliente_id'] ?? $_POST['cliente_id'];
?>

<form method="post" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
    <input type="hidden" name="id" value="<?= $val_id ?>">

    <div class="mb-3">
        <label class="form-label">Placa</label>
        <input type="text" name="placa" class="form-control" required maxlength="10" value="<?= $val_placa ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Modelo</label>
        <input type="text" name="modelo" class="form-control" required value="<?= $val_modelo ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Cor</label>
        <input type="text" name="cor" class="form-control" value="<?= $val_cor ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Cliente (Proprietário)</label>
        <select name="cliente_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach($clientes as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $val_cli) ? 'selected' : '' ?>>
                    <?= $c['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="veiculos.php" class="btn btn-secondary">Cancelar</a>
</form>
<?php else: ?>
    <div class="alert alert-danger">Veículo não encontrado.</div>
<?php endif; ?>

<?php require("footer.php"); ?>