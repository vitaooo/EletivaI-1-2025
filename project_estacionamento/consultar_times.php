<?php
    require("cabecalho.php");
    require("conexao.php");

    $equipe = null;

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            try{
                $sql = "SELECT e.id, e.nome, c.nome as nome_campeonato 
                        FROM equipe e 
                        INNER JOIN campeonato c ON e.campeonato_id = c.id
                        WHERE e.id = ?";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_GET['id']]);
                $equipe = $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (Exception $e){
                echo "Erro ao consultar equipe: ".$e->getMessage();
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        
        if($id){
            try{
                $stmt = $pdo->prepare("DELETE FROM equipe WHERE id = ?");
                if($stmt->execute([$id])){
                    header('location: times.php?excluir=true');
                    exit; 
                } else {
                    header('location: times.php?excluir=false');
                    exit;
                }
            }catch(\Exception $e){
                echo "Erro ao excluir: ".$e->getMessage();
            }
        }
    }
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Equipe</h1>

    <?php if ($equipe): ?>

        <form method="post">
            <input type="hidden" name="id" value="<?= $equipe['id'] ?>">

            <div class="mb-3">
                <label for="nome" class="form-label" style="color: black;">Nome da Equipe</label>
                <input disabled value="<?= $equipe['nome'] ?>" type="text" id="nome" class="form-control">
            </div>

            <div class="mb-3">
                <label for="times" class="form-label" style="color: black;">Participando do times</label>
                <input disabled value="<?= $equipe['nome_campeonato'] ?>" type="text" id="times" class="form-control">
            </div>

            <div class="alert alert-warning">
                <p style="color: black; margin: 0;">Deseja realmente excluir esta equipe?</p>
            </div>
            
            <button type="submit" class="btn btn-danger">Excluir Equipe</button>
            <a href="times.php" class="btn btn-secondary">Voltar</a>
        </form>

    <?php else: ?>
        
            <div class="alert alert-danger">
                <strong>Erro:</strong> Equipe não encontrada ou ID inválido.
            </div>
            <a href="times.php" class="btn btn-secondary">Voltar para a lista</a>

    <?php endif; ?>
</div>

<?php
require("footer.php"); 
?>