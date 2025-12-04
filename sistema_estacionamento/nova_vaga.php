<?php
require("cabecalho.php");
require("conexao.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $codigo = strtoupper($_POST['codigo']);
    $status = $_POST['status'];
    
    try{
        $stmt = $pdo->prepare("INSERT INTO vaga (codigo, status) VALUES (?, ?)");
        $stmt->execute([$codigo, $status]);
        header('location: vagas.php');
    }catch(\Exception $e){
        echo "<div class='alert alert-danger'>Erro: ".$e->getMessage()."</div>";
    }
}
?>

<h2 style="color: black;">Cadastrar Nova Vaga</h2>

<form method="post" style="max-width: 500px; background: white; padding: 20px; border-radius: 8px;">
    <div class="mb-3">
        <label style="color: black;">Código da Vaga (Ex: A-01)</label>
        <input type="text" name="codigo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label style="color: black;">Status Inicial</label>
        <select name="status" class="form-control">
            <option value="LIVRE">LIVRE</option>
            <option value="OCUPADA">OCUPADA</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="vagas.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("footer.php"); ?>