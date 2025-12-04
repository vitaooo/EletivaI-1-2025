<?php
    require("cabecalho.php");
    require("conexao.php");

    $campeonatos = $pdo->query("SELECT * FROM campeonato")->fetchAll();
    $equipes = $pdo->query("SELECT e.*, c.nome as camp_nome FROM equipe e JOIN campeonato c ON c.id = e.campeonato_id")->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $campeonato_id = $_POST['campeonato_id'];
        $time_casa = $_POST['time_casa'];
        $time_visitante = $_POST['time_visitante'];
        
        try{
            $stmt = $pdo->prepare("INSERT INTO partida (campeonato_id, time_casa_id, time_visitante_id, placar_casa, placar_visitante) VALUES (?, ?, ?, 0, 0)");
            $stmt->execute([$campeonato_id, $time_casa, $time_visitante]);
            header('location: partida.php');
        }catch(\Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>

<h2 style="color: black;">Agendar Nova Partida</h2>
<br>

<form method="post" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
    
    <div class="form-group">
        <label style="color: black;">Selecione o Campeonato:</label>
        <select name="campeonato_id" required>
            <?php foreach($campeonatos as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="display: flex; gap: 20px;">
        <div class="form-group" style="flex: 1;">
            <label style="color: black;">Time da Casa:</label>
            <select name="time_casa" required>
                <?php foreach($equipes as $e): ?>
                    <option value="<?= $e['id'] ?>"><?= $e['nome'] ?> (<?= $e['camp_nome'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group" style="flex: 1;">
            <label style="color: black;">Time Visitante:</label>
            <select name="time_visitante" required>
                <?php foreach($equipes as $e): ?>
                    <option value="<?= $e['id'] ?>"><?= $e['nome'] ?> (<?= $e['camp_nome'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div style="margin-top: 15px;">
        <button type="submit" class="btn btn-primary">Agendar Jogo</button>
        <a href="partida.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<?php require("rodape.php"); ?>