<?php
    require("cabecalho.php");
    require("conexao.php");

    // Processar Formulário de Nova Matrícula
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $aluno = $_POST['aluno_id'];
        $prof = $_POST['professor_id'];
        $plano = $_POST['plano_id'];
        $data = $_POST['data_inicio'];

        try {
            $stmt = $pdo->prepare("INSERT INTO matricula (aluno_id, professor_id, plano_id, data_inicio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$aluno, $prof, $plano, $data]);
        } catch(Exception $e) {
            echo "<p class='text-danger'>Erro ao matricular: ".$e->getMessage()."</p>";
        }
    }
    
    // Excluir
    if(isset($_GET['del'])){
        $pdo->prepare("DELETE FROM matricula WHERE id=?")->execute([$_GET['del']]);
        echo "<script>window.location='matriculas.php'</script>";
    }

    // Carregar listas para os selects
    $alunos = $pdo->query("SELECT * FROM aluno")->fetchAll();
    $profs = $pdo->query("SELECT * FROM professor")->fetchAll();
    $planos = $pdo->query("SELECT * FROM plano")->fetchAll();

    // Listar Matrículas
    $sql = "SELECT m.id, a.nome as aluno, p.nome as prof, pl.nome as plano, m.data_inicio 
            FROM matricula m
            JOIN aluno a ON m.aluno_id = a.id
            JOIN professor p ON m.professor_id = p.id
            JOIN plano pl ON m.plano_id = pl.id
            ORDER BY m.id DESC";
    $matriculas = $pdo->query($sql)->fetchAll();
?>

<h2>Central de Matrículas</h2>

<div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <h3 style="color: var(--primary-color); border-bottom: 1px solid #eee; padding-bottom: 10px;">Nova Matrícula</h3>
    <form method="post">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px;">
            <div>
                <label>Aluno</label>
                <select name="aluno_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach($alunos as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Professor Responsável</label>
                <select name="professor_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach($profs as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nome'] ?> (<?= $p['especialidade'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Plano</label>
                <select name="plano_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach($planos as $pl): ?>
                        <option value="<?= $pl['id'] ?>"><?= $pl['nome'] ?> - R$<?= $pl['valor'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Data Início</label>
                <input type="date" name="data_inicio" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px;">Registrar Matrícula</button>
    </form>
</div>

<div class="matches-list"> <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Professor</th>
                <th>Plano</th>
                <th>Início</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($matriculas as $m): ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= $m['aluno'] ?></td>
                    <td><?= $m['prof'] ?></td>
                    <td><?= $m['plano'] ?></td>
                    <td><?= date('d/m/Y', strtotime($m['data_inicio'])) ?></td>
                    <td><a href="matriculas.php?del=<?= $m['id'] ?>" class="btn btn-danger" style="padding: 5px 10px;">Cancelar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require("footer.php"); ?>