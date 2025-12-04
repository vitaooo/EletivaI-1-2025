<?php
require("cabecalho.php");
require("conexao.php");

try {
    // Join para mostrar o nome do campeonato
    $sql = "SELECT e.*, c.nome as camp_nome, o.nome as organizador FROM equipe e 
                INNER JOIN campeonato c ON c.id = e.campeonato_id
                INNER JOIN organizador o ON o.id = c.organizador_id";
    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}

if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true') {
    echo "<p style='color: green; font-weight: bold;'>time cadastrado!</p>";
} else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false') {
    echo "<p style='color: red; font-weight: bold;'>Erro ao cadastrar!</p>";
}

if (isset($_GET['editar']) && $_GET['editar'] == 'true') {
    echo "<p style='color: green; font-weight: bold;'>Time editado com sucesso!</p>";
} else if (isset($_GET['editar']) && $_GET['editar'] == 'false') {
    echo "<p style='color: red; font-weight: bold;'>Erro ao editar!</p>";
}

if (isset($_GET['excluir']) && $_GET['excluir']) {
    echo "<p class=='text-success' color: b>Time excluído!</p>";
} else if (isset($_GET['excluir']) && !$_GET['excluir']) {
    echo "<p class='text-danger'>Erro ao excluir!</p>";
}


?>

<a href="novo_time.php" class="btn btn-success" style="width: 10%; background-color: #ffc107;">Nova Equipe</a>
<div class="campeonato-main">

    <table class="styled-table">
        <thead>
            <tr style="background-color: black"> 
                <th style="color: white; text-align: left;">Nome da Equipe</th>
                <th style="color: white; text-align: left; margin-bottom: 10px;">Campeonato</th>
                <th style="color: white; text-align: left; margin-bottom: 10px;">Organizador</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados as $d): ?>
                <tr>
                    <td style="color: black; margin-top: 10px;"><?= $d['nome'] ?></td>
                    <td style="color: black;"><?= $d['camp_nome'] ?></td>
                    <td style="color: black;"><?= $d['organizador'] ?></td>
                    <td style="display: flex; gap: 2px;">
                        <a href="editar_times.php?id=<?= $d['id'] ?>" class="btn" style="background-color: #ffc107">Editar</a>
                        <a href="consultar_times.php?id=<?= $d['id'] ?>" class="btn btn-primary">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require("footer.php"); ?>