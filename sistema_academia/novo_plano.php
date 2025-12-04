<?php
    require("conexao.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        
        try{
            $stmt = $pdo->prepare("INSERT INTO plano (nome, valor) VALUES (?, ?)");
            $stmt->execute([$nome, $valor]);
            header('location: planos.php?msg=sucesso');
            exit();
        } catch(PDOException $e){
            $erro = "Erro: " . $e->getMessage();
        }
    }
    require("cabecalho.php"); 
?>

<h2 style="color: var(--primary-dark);">Novo Plano</h2>

<form method="post" style="background: white; padding: 30px; border-radius: 10px;">
    <div class="form-group">
        <label>Nome do Plano (Ex: Mensal, Trimestral)</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Valor (R$)</label>
        <input type="number" step="0.01" name="valor" class="form-control" required>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Criar Plano</button>
        <a href="planos.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php require("footer.php"); ?>