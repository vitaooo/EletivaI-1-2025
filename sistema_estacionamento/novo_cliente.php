<?php
require("conexao.php");
$erro = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
    
    try{
        $sql = "INSERT INTO cliente (nome, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$nome, $cpf, $telefone, $email, $senha])){
            header('location: clientes.php?cadastro=true');
            exit; 
        } else {
            header('location: clientes.php?cadastro=false');
            exit;
        }
    }catch(\Exception $e){
        $erro = "Erro ao salvar (verifique se CPF ou Email já existem): " . $e->getMessage();
    }
}

require("cabecalho.php");
?>

<div class="header-flex">
    <h2 style="color: black;">Novo Cliente</h2>
</div>

<?php if(!empty($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form method="post" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" required maxlength="14" placeholder="000.000.000-00">
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email (Login)</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="clientes.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("footer.php"); ?>