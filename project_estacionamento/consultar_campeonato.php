<?php
require("cabecalho.php");
require("conexao.php");

$campeonato = null;

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("SELECT 
                                        c.id, 
                                        c.nome AS nome_campeonato, 
                                        o.nome AS nome_organizador 
                                       FROM campeonato c
                                       INNER JOIN organizador o ON c.organizador_id = o.id
                                       WHERE c.id = ?");
            $stmt->execute([$_GET['id']]);
            $campeonato = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao consultar: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    try {
        $stmt = $pdo->prepare("DELETE from campeonato WHERE id = ?");
        if ($stmt->execute([$id])) {
            header('location: campeonato.php?excluir=true');
        } else {
            header('location: campeonato.php?excluir=false');
        }
    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Campeonato</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <div class="mb-3">
        <label for="nome" class="form-label" style="color: black;">Informe o nome do Campeonato</label>
        <input disabled value="<?= $campeonato['nome_campeonato'] ?>" type="text" id="nome" name="nome" class="form-control" required="">
    </div>
    <p style="color: black;">Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Excluir</button>
    <button onclick="history.back();" type="button" class="btn btn-secondary">Voltar</button>
</form>
</div>

<?php
require("footer.php");
?>