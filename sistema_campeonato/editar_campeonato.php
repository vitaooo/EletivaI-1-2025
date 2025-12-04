<?php
    require("cabecalho.php");
    require("conexao.php");

    
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                $stmt = $pdo->prepare("SELECT * FROM campeonato WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e){
                echo "Erro ao consultar: ".$e->getMessage();
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $id = $_POST['id'];

        try{
            $stmt = $pdo->prepare("UPDATE campeonato set nome = ? WHERE id = ?");
            if($stmt->execute([$nome, $id])){
                header('location: campeonato.php?editar=true');
            } else {
                header('location: campeonato.php?editar=false');
            }
        }catch(\Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>

<div class="header-flex">
    <h2 style="color: black;">Editar Campeonato</h2>
</div>

<form method="post" style="max-width: 600px;">
    <input type="hidden" name="id" value="<?= isset($dados['id']) ? $dados['id'] : '' ?>">
    
    <div class="mb-3 form-group">
        <label for="nome" class="form-label" style="color: black;">Nome do campeonato</label>
        <input value="<?= isset($dados['nome']) ? $dados['nome'] : '' ?>" type="text" id="nome" name="nome" class="form-control" required="">
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="campeonato.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require("footer.php");
?>