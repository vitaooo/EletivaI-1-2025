<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    
    $stmt = $pdo->prepare("SELECT * FROM professor WHERE id = ?");
    $stmt->execute([$id]);
    $prof = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['excluir_id'])){
        $pdo->prepare("DELETE FROM professor WHERE id=?")->execute([$_POST['excluir_id']]);
        header('location: professores.php?msg=excluido');
    }
?>

<h2 style="color: var(--primary-dark);">Consultar Professor</h2>

<?php if($prof): ?>
    <div style="background: white; padding: 30px; border-radius: 10px; border-left: 5px solid var(--primary-color);">
        <div class="form-group">
            <label>ID</label>
            <input type="text" value="<?= $prof['id'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="<?= $prof['nome'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Especialidade</label>
            <input type="text" value="<?= $prof['especialidade'] ?>" class="form-control" disabled>
        </div>

        <form method="post" style="margin-top: 20px;">
            <input type="hidden" name="excluir_id" value="<?= $prof['id'] ?>">
            <a href="editar_professor.php?id=<?= $prof['id'] ?>" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Excluir professor?');">Excluir</button>
            <a href="professores.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
<?php endif; ?>

<?php require("footer.php"); ?>