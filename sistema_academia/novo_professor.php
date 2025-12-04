<?php
    require("conexao.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $esp = $_POST['especialidade'];
        
        try{
            $stmt = $pdo->prepare("INSERT INTO professor (nome, especialidade) VALUES (?, ?)");
            $stmt->execute([$nome, $esp]);
            header('location: professores.php?msg=sucesso');
            exit();
        } catch(PDOException $e){
            $erro = "Erro: " . $e->getMessage();
        }
    }
    require("cabecalho.php"); 
?>

<h2 style="color: var(--primary-dark);">Novo Professor</h2>

<form method="post" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <div class="form-group">
        <label>Nome do Professor</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Especialidade (Ex: Musculação, Pilates)</label>
        <input type="text" name="especialidade" class="form-control" required>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Cadastrar Professor</button>
        <a href="professores.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php require("footer.php"); ?>