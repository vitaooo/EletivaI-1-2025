<?php
require("cabecalho.php");
require("conexao.php");

try {
    $stmt = $pdo->query("SELECT 
    c.id AS id_campeonato,
    c.nome AS nome_campeonato,
    o.nome AS nome_organizador
FROM 
    campeonato AS c
INNER JOIN 
    organizador AS o ON c.organizador_id = o.id;");
    $dados = $stmt->fetchAll();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}

if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true') {
    echo "<p style='color: green; font-weight: bold;'>Cadastro realizado com sucesso!</p>";
} else if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'false') {
    echo "<p style='color: red; font-weight: bold;'>Erro ao cadastrar!</p>";
}

if (isset($_GET['editar']) && $_GET['editar'] == 'true') {
    echo "<p style='color: green; font-weight: bold;'>Registro editado com sucesso!</p>";
} else if (isset($_GET['editar']) && $_GET['editar'] == 'false') {
    echo "<p style='color: red; font-weight: bold;'>Erro ao editar!</p>";
}

if (isset($_GET['excluir']) && $_GET['excluir']) {
    echo "<p style='color: black;'>Campeonato excluído!</p>";
} else if (isset($_GET['excluir']) && !$_GET['excluir']) {
    echo "<p class='text-danger'>Erro ao excluir!</p>";
}

?>
<div class="header-flex">
    <a href="novo_campeonato.php" class="btn btn-success" style="background-color: #ffc107">Novo Campeonato</a>
</div>
<div class="campeonato-main">

    <table class="styled-table">
        <thead style="width: 100%;">
            <tr style="background-color: black">
                <th>ID</th>
                <th>Campeonato</th>
                <th>Organizador</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados as $d): ?>
                <tr>
                    <td style="color: black;"><?= $d['id_campeonato'] ?></td>
                    <td style="color: black;"><?= $d['nome_campeonato'] ?></td>
                    <td style="color: black;"><?= $d['nome_organizador'] ?></td>
                    <td style="display: flex; gap: 2px;">
                        <a href="editar_campeonato.php?id=<?= $d['id_campeonato'] ?>" class="btn" style="background-color: #ffc107">Editar</a>
                        <a href="consultar_campeonato.php?id=<?= $d['id_campeonato'] ?>" class="btn btn-primary">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require("footer.php"); ?>