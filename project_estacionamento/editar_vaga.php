<?php
require("cabecalho.php");
require("conexao.php");

if(isset($_GET['id'])){
    $stmt = $pdo->prepare("SELECT * FROM vaga WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $codigo = strtoupper($_POST['codigo']);
    $status = $_POST['status'];

    try{
        $stmt = $pdo->prepare("UPDATE vaga SET codigo = ?, status = ? WHERE id = ?");
        $stmt->execute([$codigo, $status, $id]);
        header('location: vagas.php');
    }catch(\Exception $e){
        echo "<div class='alert alert-danger'>Erro: ".$e->getMessage()."</div>";
    }
}
?>

<h2 style="color: black;">Editar Vaga</h2>

<form method="post" style="max-width: 500px; background: white; padding: 20px; border-radius: 8px;">
    <input type="hidden" name="id" value="<?= $dados['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label>Código</label>
        <input value="<?= $dados['codigo'] ?? '' ?>" type="text" name="codigo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="LIVRE" <?= ($dados['status'] == 'LIVRE') ? 'selected' : '' ?>>LIVRE</option>
            <option value="OCUPADA" <?= ($dados['status'] == 'OCUPADA') ? 'selected' : '' ?>>OCUPADA</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="vagas.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("footer.php"); ?>