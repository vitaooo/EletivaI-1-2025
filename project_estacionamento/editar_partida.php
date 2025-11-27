<?php
    require("cabecalho.php");
    require("conexao.php");

    // 1. Busca os dados da partida atual (GET)
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                $stmt = $pdo->prepare("SELECT * FROM partida WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(!$dados) {
                    echo "Partida não encontrada.";
                    exit;
                }

            } catch (Exception $e){
                echo "Erro ao consultar: ".$e->getMessage();
            }
        }
    }

    // 2. Carrega listas para os Selects (Campeonatos e Times)
    try {
        // Busca Campeonatos
        $sql_camp = "SELECT id, nome FROM campeonato";
        $stmt_camp = $pdo->query($sql_camp);
        $lista_campeonatos = $stmt_camp->fetchAll(PDO::FETCH_ASSOC);

        // Busca Times (Equipes)
        $sql_times = "SELECT id, nome FROM equipe";
        $stmt_times = $pdo->query($sql_times);
        $lista_times = $stmt_times->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        echo "Erro ao carregar listas: " . $e->getMessage();
    }


    // 3. Lógica para SALVAR os dados (POST)
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $campeonato_id = $_POST['campeonato_id'];
        $time_casa_id = $_POST['time_casa_id'];
        $time_visitante_id = $_POST['time_visitante_id'];
        $placar_casa = $_POST['placar_casa'];
        $placar_visitante = $_POST['placar_visitante'];

        try{
            // Validação simples para não permitir mesmo time jogando contra si mesmo
            if($time_casa_id == $time_visitante_id){
                throw new Exception("O time da casa e o visitante não podem ser iguais.");
            }

            $sql_update = "UPDATE partida SET 
                            campeonato_id = ?, 
                            time_casa_id = ?, 
                            time_visitante_id = ?, 
                            placar_casa = ?, 
                            placar_visitante = ? 
                           WHERE id = ?";
            
            $stmt = $pdo->prepare($sql_update);
            
            if($stmt->execute([$campeonato_id, $time_casa_id, $time_visitante_id, $placar_casa, $placar_visitante, $id])){
                header('location: partida.php?editar=true');
                exit;
            } else {
                header('location: partida.php?editar=false');
                exit;
            }
        }catch(\Exception $e){
            echo "<div class='alert alert-danger'>Erro: ".$e->getMessage()."</div>";
        }
    }
?>

<div class="header-flex">
    <h2 style="color: black;">Editar Partida</h2>
</div>

<form method="post" style="max-width: 800px;">
    <input type="hidden" name="id" value="<?= isset($dados['id']) ? $dados['id'] : '' ?>">
    
    <div class="mb-3 form-group">
        <label for="campeonato_id" class="form-label" style="color: black;">Campeonato</label>
        <select name="campeonato_id" id="campeonato_id" class="form-control" required>
            <option value="">Selecione...</option>
            <?php foreach($lista_campeonatos as $camp): ?>
                <?php 
                    $selected = (isset($dados['campeonato_id']) && $dados['campeonato_id'] == $camp['id']) ? 'selected' : ''; 
                ?>
                <option value="<?= $camp['id'] ?>" <?= $selected ?>>
                    <?= $camp['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-5">
            <h4 style="color: black; text-align: center;">Casa</h4>
            <div class="mb-3 form-group">
                <label for="time_casa_id" class="form-label" style="color: black;">Time</label>
                <select name="time_casa_id" id="time_casa_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach($lista_times as $time): ?>
                        <?php $selected = (isset($dados['time_casa_id']) && $dados['time_casa_id'] == $time['id']) ? 'selected' : ''; ?>
                        <option value="<?= $time['id'] ?>" <?= $selected ?>><?= $time['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="placar_casa" class="form-label" style="color: black;">Gols (Placar)</label>
                <input value="<?= isset($dados['placar_casa']) ? $dados['placar_casa'] : '0' ?>" type="number" id="placar_casa" name="placar_casa" class="form-control" min="0" required>
            </div>
        </div>

        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <h2 style="color: #666;">X</h2>
        </div>

        <div class="col-md-5">
            <h4 style="color: black; text-align: center;">Visitante</h4>
            <div class="mb-3 form-group">
                <label for="time_visitante_id" class="form-label" style="color: black;">Time</label>
                <select name="time_visitante_id" id="time_visitante_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach($lista_times as $time): ?>
                        <?php $selected = (isset($dados['time_visitante_id']) && $dados['time_visitante_id'] == $time['id']) ? 'selected' : ''; ?>
                        <option value="<?= $time['id'] ?>" <?= $selected ?>><?= $time['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="placar_visitante" class="form-label" style="color: black;">(Placar)</label>
                <input value="<?= isset($dados['placar_visitante']) ? $dados['placar_visitante'] : '0' ?>" type="number" id="placar_visitante" name="placar_visitante" class="form-control" min="0" required>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="partida.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php
require("footer.php");
?>