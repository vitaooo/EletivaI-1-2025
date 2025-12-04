<?php
    // 1. Primeiro a conexão e configurações
    require("conexao.php");

    // 2. Processa o formulário ANTES de qualquer HTML
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $campeonato_id = $_POST['campeonato_id'];
        
        try{
            $sql = "INSERT INTO equipe (nome, campeonato_id) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if($stmt->execute([$nome, $campeonato_id])){
                header('location: times.php?cadastro=true');
                exit(); // Importante: pare o script após redirecionar
            } else {
                header('location: times.php?cadastro=false');
                exit();
            }
        } catch(PDOException $e){ // Captura específica do PDO é melhor
            // Se der erro, vamos mostrar na tela (mas idealmente logar)
            $erro = "Erro ao salvar: " . $e->getMessage();
        }
    }

    // 3. Busca os dados para o select (pode ficar aqui)
    $stmt = $pdo->query("SELECT * FROM campeonato");
    $campeonatos = $stmt->fetchAll();

    // 4. AGORA sim incluímos o cabeçalho visual
    require("cabecalho.php"); 
?>

<?php if(isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<h1 style="color: black;">Nova Equipe</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label" style="color: black;">Nome da Equipe</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="campeonato_id" class="form-label">Campeonato</label>
        <select name="campeonato_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach($campeonatos as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="times.php" class="btn btn-secondary">Voltar</a>
</form>

<?php require("footer.php"); ?>