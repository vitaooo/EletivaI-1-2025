<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    
    if($id){
        $stmt = $pdo->prepare("SELECT * FROM plano WHERE id = ?");
        $stmt->execute([$id]);
        $plano = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $id_plano = $_POST['id'];

        $stmt = $pdo->prepare("UPDATE plano SET nome=?, valor=? WHERE id=?");
        $stmt->execute([$nome, $valor, $id_plano]);
        header('location: planos.php?msg=editado');
    }
?>

<h2 style="color: var(--primary-dark);">Editar Plano</h2>

<form method="post" style="background: white; padding: 30px; border-radius: 10px;">
    <input type="hidden" name="id" value="<?= $plano['id'] ?>">
    
    <div class="form-group">
        <label>Nome do Plano</label>
        <input type="text" name="nome" value="<?= $plano['nome'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Valor (R$)</label>
        <input type="number" step="0.01" name="valor" value="<?= $plano['valor'] ?>" class="form-control" required>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Salvar Plano</button>
        <a href="planos.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require("footer.php"); ?>