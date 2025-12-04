<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    $aluno = null;

    if($id){
        $stmt = $pdo->prepare("SELECT * FROM aluno WHERE id = ?");
        $stmt->execute([$id]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lógica de Exclusão dentro da consulta
    if(isset($_POST['excluir_id'])){
        $pdo->prepare("DELETE FROM aluno WHERE id=?")->execute([$_POST['excluir_id']]);
        echo "<script>window.location='alunos.php?msg=excluido';</script>";
    }
?>

<h2 style="color: var(--primary-dark);">Consultar Aluno</h2>

<?php if($aluno): ?>
    <div style="background: white; padding: 30px; border-radius: 10px; border-left: 5px solid var(--primary-color);">
        <div class="form-group">
            <label>ID do Sistema</label>
            <input type="text" value="<?= $aluno['id'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Nome</label>
            <input type="text" value="<?= $aluno['nome'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" value="<?= $aluno['email'] ?>" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" value="<?= $aluno['data_nascimento'] ?>" class="form-control" disabled>
        </div>

        <form method="post" style="margin-top: 20px;" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
            <input type="hidden" name="excluir_id" value="<?= $aluno['id'] ?>">
            <a href="editar_aluno.php?id=<?= $aluno['id'] ?>" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger">Excluir Registro</button>
            <a href="alunos.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
<?php else: ?>
    <p>Aluno não encontrado.</p>
<?php endif; ?>

<?php require("footer.php"); ?>