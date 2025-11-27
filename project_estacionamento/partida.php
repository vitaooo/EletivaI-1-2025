<?php
    require("cabecalho.php");
    require("conexao.php");

    try{
        $sql = "SELECT p.*, 
                       c.nome as camp_nome,
                       tc.nome as casa_nome,
                       tv.nome as vis_nome
                FROM partida p 
                INNER JOIN campeonato c ON c.id = p.campeonato_id
                INNER JOIN equipe tc ON tc.id = p.time_casa_id
                INNER JOIN equipe tv ON tv.id = p.time_visitante_id
                ORDER BY p.id DESC"; 
        $stmt = $pdo->query($sql);
        $partidas = $stmt->fetchAll();
    } catch(\Exception $e) {
        echo "<p style='color:red'>Erro: ".$e->getMessage()."</p>";
    }
?>

<h2 style="color: black;">Central de Partidas</h2>
<div class="header-flex">
    <a href="nova_partida.php" class="btn btn-success" style="color: black; margin-bottom: 10px; background-color: #ffc107;">Nova Partida</a>
</div>

<?php if(count($partidas) == 0): ?>
    <div style="text-align:center; padding: 40px; background: white; border-radius: 8px;">
        <p style="color: black;">Nenhuma partida agendada.</p>
    </div>
<?php endif; ?>

<div class="matches-list">
    <?php foreach($partidas as $p): ?>
        <div class="match-card">
            <div class="match-header">
                <?= $p['camp_nome'] ?>
            </div>

            <div class="match-body">
                
                <div class="team">
                    <span class="team-label" style="color: black;">Casa</span>
                    <span class="team-name"><?= $p['casa_nome'] ?></span>
                </div>

                <div class="scoreboard">
                    <div class="score">
                        <?= $p['placar_casa'] ?> - <?= $p['placar_visitante'] ?>
                    </div>
                    
                </div>

                <div class="team">
                    <span class="team-label" style="color: black;">Visitante</span>
                    <span class="team-name"><?= $p['vis_nome'] ?></span>
                </div>
                <div style="margin-top: 10px; display: flex; gap: 10px; justify-content: center;">
                        <a href="editar_partida.php?id=<?= $p['id'] ?>" class="btn btn-partida" style="background-color: #ffc107;">
                            Editar
                        </a>
                        <a href="consultar_partida.php?id=<?= $p['id'] ?>" class="btn btn-partida">
                            Consultar
                        </a>
                    </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require("footer.php"); ?>