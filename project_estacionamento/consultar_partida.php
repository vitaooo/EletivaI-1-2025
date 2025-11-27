<?php
    require("cabecalho.php");
    require("conexao.php");

    $partida = null;

    // 1. Lógica para CARREGAR os dados (GET)
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                // Fazemos os JOINS para pegar os nomes dos times e do campeonato
                $sql = "SELECT p.*, 
                               c.nome as camp_nome,
                               tc.nome as casa_nome,
                               tv.nome as vis_nome
                        FROM partida p 
                        INNER JOIN campeonato c ON c.id = p.campeonato_id
                        INNER JOIN equipe tc ON tc.id = p.time_casa_id
                        INNER JOIN equipe tv ON tv.id = p.time_visitante_id
                        WHERE p.id = ?";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                $partida = $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (Exception $e){
                echo "Erro ao consultar partida: ".$e->getMessage();
            }
        }
    }

    // 2. Lógica para EXCLUIR os dados (POST)
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        
        if($id){
            try{
                $stmt = $pdo->prepare("DELETE FROM partida WHERE id = ?");
                if($stmt->execute([$id])){
                    header('location: partida.php?excluir=true');
                    exit; 
                } else {
                    header('location: partida.php?excluir=false');
                    exit;
                }
            }catch(\Exception $e){
                echo "Erro ao excluir: ".$e->getMessage();
            }
        }
    }
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Partida</h1>

    <?php if ($partida): ?>

        <form method="post" style="max-width: 800px;">
            <input type="hidden" name="id" value="<?= $partida['id'] ?>">

            <div class="mb-3">
                <label for="campeonato" class="form-label" style="color: black;">Campeonato</label>
                <input disabled value="<?= $partida['camp_nome'] ?>" type="text" id="campeonato" class="form-control">
            </div>

            <hr>

            <div class="row">
                <div class="col-md-5">
                    <h4 style="color: black; text-align: center;">Casa</h4>
                    <div class="mb-3">
                        <label class="form-label" style="color: black;">Time</label>
                        <input disabled value="<?= $partida['casa_nome'] ?>" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: black;">Gols</label>
                        <input disabled value="<?= $partida['placar_casa'] ?>" type="number" class="form-control">
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <h2 style="color: #666;">X</h2>
                </div>

                <div class="col-md-5">
                    <h4 style="color: black; text-align: center;">Visitante</h4>
                    <div class="mb-3">
                        <label class="form-label" style="color: black;">Time</label>
                        <input disabled value="<?= $partida['vis_nome'] ?>" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: black;">Gols</label>
                        <input disabled value="<?= $partida['placar_visitante'] ?>" type="number" class="form-control">
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" style="margin-top: 20px;">
                <p style="color: black; margin: 0;">Deseja realmente excluir esta partida?</p>
            </div>
            
            <button type="submit" class="btn btn-danger">Excluir Partida</button>
            <a href="partida.php" class="btn btn-secondary">Voltar</a>
        </form>

    <?php else: ?>
        
        <div class="alert alert-danger">
            <strong>Erro:</strong> Partida não encontrada ou ID inválido.
        </div>
        <a href="partida.php" class="btn btn-secondary">Voltar para a lista</a>

    <?php endif; ?>
</div>

<?php
require("footer.php"); 
?>