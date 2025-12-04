<?php
    require("conexao.php");
    require("cabecalho.php");

    $id = $_GET['id'] ?? null;
    
    // Buscar dados atuais
    if($id){
        $stmt = $pdo->prepare("SELECT * FROM aluno WHERE id = ?");
        $stmt->execute([$id]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Processar atualização
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nasc = $_POST['data_nascimento'];
        $id_aluno = $_POST['id'];

        try{
            $stmt = $pdo->prepare("UPDATE aluno SET nome=?, email=?, data_nascimento=? WHERE id=?");
            $stmt->execute([$nome, $email, $nasc, $id_aluno]);
            echo "<script>window.location='alunos.php?msg=editado';</script>";
        }catch(PDOException $e){
            echo "<p class='text-danger'>Erro: ".$e->getMessage()."</p>";
        }
    }
?>

<h2 style="color: var(--primary-dark);">Editar Aluno</h2>

<form method="post" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
    
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= $aluno['nome'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= $aluno['email'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Nascimento</label>
        <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>" class="form-control">
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="alunos.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require("footer.php"); ?>