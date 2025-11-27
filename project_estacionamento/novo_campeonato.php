<?php
    require("conexao.php");

    $erro = "";

    // 1. Antes de tudo, buscamos a lista de organizadores para preencher o select
    try {
        $stmt_org = $pdo->query("SELECT id, nome FROM organizador");
        $organizadores = $stmt_org->fetchAll();
    } catch(Exception $e) {
        $erro = "Erro ao buscar organizadores: " . $e->getMessage();
    }

    // 2. Processa o formulário
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $organizador_id = $_POST['organizador_id']; // Pegamos o ID escolhido no select
        
        try{
            // 3. Atualizamos o INSERT para incluir a coluna organizador_id
            $stmt = $pdo->prepare("INSERT INTO campeonato (nome, organizador_id) VALUES (?, ?)");
            
            if($stmt->execute([$nome, $organizador_id])){
                header('location: campeonato.php?cadastro=true');
                exit; 
            } else {
                header('location: campeonato.php?cadastro=false');
                exit;
            }
        }catch(\Exception $e){
            $erro = "Erro ao salvar: " . $e->getMessage();
        }
    }

    require("cabecalho.php");
?>

<div class="header-flex">
    <h2 style="color: black;">Novo Campeonato</h2>
</div>

<?php if(!empty($erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $erro ?>
    </div>
<?php endif; ?>

<form method="post" style="max-width: 600px;">
    <div class="mb-3 form-group">
        <label for="nome" class="form-label" style="color:black">Informe o nome do campeonato</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3 form-group">
        <label for="organizador_id" class="form-label" style="color:black">Organizador Responsável</label>
        <select name="organizador_id" id="organizador_id" class="form-control" required>
            <option value="">Selecione um organizador...</option>
            <?php foreach($organizadores as $org): ?>
                <option value="<?= $org['id'] ?>"><?= $org['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="campeonato.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("footer.php"); ?>