<?php
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $placa = strtoupper($_POST['placa']);
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $cliente_id = $_POST['cliente_id'];
    
    try{
        $sql = "INSERT INTO veiculo (placa, modelo, cor, cliente_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$placa, $modelo, $cor, $cliente_id])){
            header('location: veiculos.php?cadastro=true');
            exit();
        } else {
            header('location: veiculos.php?cadastro=false');
            exit();
        }
    } catch(PDOException $e){
        $erro = "Erro ao salvar (Placa já existe?): " . $e->getMessage();
    }
}

$clientes = $pdo->query("SELECT id, nome FROM cliente")->fetchAll();

require("cabecalho.php"); 
?>

<?php if(isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<h2 style="color: black;">Novo Veículo</h2>
<form method="post" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
    <div class="mb-3">
        <label class="form-label">Placa</label>
        <input type="text" name="placa" class="form-control" required maxlength="10" placeholder="ABC-1234">
    </div>
    <div class="mb-3">
        <label class="form-label">Modelo</label>
        <input type="text" name="modelo" class="form-control" required placeholder="Ex: Gol 1.0">
    </div>
    <div class="mb-3">
        <label class="form-label">Cor</label>
        <input type="text" name="cor" class="form-control" placeholder="Ex: Prata">
    </div>
    <div class="mb-3">
        <label class="form-label">Cliente (Proprietário)</label>
        <select name="cliente_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach($clientes as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="veiculos.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("footer.php"); ?>