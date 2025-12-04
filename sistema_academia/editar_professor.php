<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    
    if($id){
        $stmt = $pdo->prepare("SELECT * FROM professor WHERE id = ?");
        $stmt->execute([$id]);
        $prof = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $esp = $_POST['especialidade'];
        $id_prof = $_POST['id'];

        $stmt = $pdo->prepare("UPDATE professor SET nome=?, especialidade=? WHERE id=?");
        $stmt->execute([$nome, $esp, $id_prof]);
        header('location: professores.php?msg=editado');
    }
?>

<h2 style="color: var(--primary-dark);">Editar Professor</h2>

<form method="post" style="background: white; padding: 30px; border-radius: 10px;">
    <input type="hidden" name="id" value="<?= $prof['id'] ?>">
    
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= $prof['nome'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Especialidade</label>
        <input type="text" name="especialidade" value="<?= $prof['especialidade'] ?>" class="form-control" required>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="professores.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require("footer.php"); ?>