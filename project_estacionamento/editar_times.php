<?php
    require("cabecalho.php");
    require("conexao.php");

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                $stmt = $pdo->prepare("SELECT * FROM equipe WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!$dados) {
                    echo "Equipe não encontrada.";
                    exit;
                }

            } catch (Exception $e){
                echo "Erro ao consultar: ".$e->getMessage();
            }
        }
    }
    try {
        $sql_camp = "SELECT c.id, c.nome, o.nome as nome_organizador 
                     FROM campeonato c 
                     INNER JOIN organizador o ON c.organizador_id = o.id";
        $stmt_camp = $pdo->query($sql_camp);
        $lista_campeonatos = $stmt_camp->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erro ao carregar campeonatos: " . $e->getMessage();
    }


    // 3. Lógica para SALVAR os dados (POST)
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $id = $_POST['id'];
        $campeonato_id = $_POST['campeonato_id']; // Novo campo recebido

        try{
            // Atualizamos o Nome E o Campeonato (que define o organizador)
            $stmt = $pdo->prepare("UPDATE equipe set nome = ?, campeonato_id = ? WHERE id = ?");
            
            if($stmt->execute([$nome, $campeonato_id, $id])){
                header('location: times.php?editar=true');
                exit;
            } else {
                header('location: times.php?editar=false');
                exit;
            }
        }catch(\Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>

<div class="header-flex">
    <h2 style="color: black;">Editar Time e Campeonato</h2>
</div>

<form method="post" style="max-width: 600px;">
    <input type="hidden" name="id" value="<?= isset($dados['id']) ? $dados['id'] : '' ?>">
    
    <div class="mb-3 form-group">
        <label for="nome" class="form-label" style="color: black;">Nome do time</label>
        <input value="<?= isset($dados['nome']) ? $dados['nome'] : '' ?>" type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3 form-group">
        <label for="campeonato_id" class="form-label" style="color: black;">Campeonato (Organizador)</label>
        <select name="campeonato_id" id="campeonato_id" class="form-control" required>
            <option value="">Selecione um campeonato...</option>
            
            <?php foreach($lista_campeonatos as $camp): ?>
                <?php 
                    // Verifica se esse é o campeonato atual do time para deixar selecionado
                    $selected = (isset($dados['campeonato_id']) && $dados['campeonato_id'] == $camp['id']) ? 'selected' : ''; 
                ?>
                <option value="<?= $camp['id'] ?>" <?= $selected ?>>
                    <?= $camp['nome'] ?> (Org: <?= $camp['nome_organizador'] ?>)
                </option>
            <?php endforeach; ?>
            
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="times.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require("footer.php");
?>