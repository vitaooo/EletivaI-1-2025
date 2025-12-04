<?php
    require("conexao.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nasc = $_POST['data_nascimento'];
        
        try{
            $stmt = $pdo->prepare("INSERT INTO aluno (nome, email, data_nascimento) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $nasc]);
            header('location: alunos.php?msg=sucesso');
            exit();
        } catch(PDOException $e){
            $erro = "Erro ao salvar: " . $e->getMessage();
        }
    }
    require("cabecalho.php"); 
?>

<div class="header-flex">
    <h2 style="color: var(--primary-dark);">Novo Aluno</h2>
</div>

<?php if(isset($erro)): ?>
    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;"><?= $erro ?></div>
<?php endif; ?>

<form method="post" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <div class="form-group">
        <label>Nome Completo</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento" class="form-control">
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Salvar Cadastro</button>
        <a href="alunos.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php require("footer.php"); ?>