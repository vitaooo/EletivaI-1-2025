<?php
    require("cabecalho.php");
    require("conexao.php");

    // 1. Busca dados do cliente
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                $stmt = $pdo->prepare("SELECT * FROM cliente WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    }

    // 2. Salva alterações
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        try{
            // Nota: Não estamos atualizando a senha aqui para simplificar
            $sql = "UPDATE cliente SET nome = ?, cpf = ?, telefone = ?, email = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            if($stmt->execute([$nome, $cpf, $telefone, $email, $id])){
                header('location: clientes.php?editar=true');
                exit;
            } else {
                header('location: clientes.php?editar=false');
                exit;
            }
        }catch(\Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>

<h2 style="color: black;">Editar Cliente</h2>

<form method="post" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
    <input type="hidden" name="id" value="<?= $dados['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label>Nome</label>
        <input value="<?= $dados['nome'] ?? '' ?>" type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>CPF</label>
        <input value="<?= $dados['cpf'] ?? '' ?>" type="text" name="cpf" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input value="<?= $dados['telefone'] ?? '' ?>" type="text" name="telefone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input value="<?= $dados['email'] ?? '' ?>" type="email" name="email" class="form-control" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("footer.php"); ?>