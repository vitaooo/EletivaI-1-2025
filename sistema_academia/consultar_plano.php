<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    
    $stmt = $pdo->prepare("SELECT * FROM plano WHERE id = ?");
    $stmt->execute([$id]);
    $plano = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['excluir_id'])){
        $pdo->prepare("DELETE FROM plano WHERE id=?")->execute([$_POST['excluir_id']]);
        header('location: planos.php?msg=excluido');
    }
?>

<h2 style="color: var(--primary-dark);">Consultar Plano</h2>

<?php if($plano): ?>
    <div style="background: white; padding: 30px; border-radius: 10px; border-left: 5px solid var(--primary-color);">
        <div class="form-group">
            <label>ID</label>
            <input type="text" value="<?= $plano['id'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="<?= $plano['nome'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input type="text" value="R$ <?= $plano['valor'] ?>" class="form-control" disabled>
        </div>

        <form method="post" style="margin-top: 20px;">
            <input type="hidden" name="excluir_id" value="<?= $plano['id'] ?>">
            <a href="editar_plano.php?id=<?= $plano['id'] ?>" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Excluir este plano?');">Excluir</button>
            <a href="planos.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
<?php endif; ?>

<?php require("footer.php"); ?>