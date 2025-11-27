<?php
    require("cabecalho.php");
    require("conexao.php");

    try {
        $sql = "SELECT 
                    o.id AS org_id, 
                    o.nome AS org_nome,
                    c.id AS camp_id, 
                    c.nome AS camp_nome,
                    p.id AS part_id,
                    p.placar_casa,
                    p.placar_visitante,
                    t1.nome AS time_casa,
                    t2.nome AS time_visitante
                FROM partida p
                INNER JOIN campeonato c ON p.campeonato_id = c.id
                INNER JOIN organizador o ON c.organizador_id = o.id
                INNER JOIN equipe t1 ON p.time_casa_id = t1.id
                INNER JOIN equipe t2 ON p.time_visitante_id = t2.id
                ORDER BY p.id DESC";

        $stmt = $pdo->query($sql);
        $dados = $stmt->fetchAll();

    } catch(\Exception $e) {
        echo "Erro: ".$e->getMessage();
    }

    if (isset($_GET['cadastro']) && $_GET['cadastro']){
        echo "<p class='text-success'>Cadastro realizado!</p>";
    } else if (isset($_GET['cadastro']) && !$_GET['cadastro']) {
        echo "<p class='text-danger'>Erro ao cadastrar!</p>";
    }

    if (isset($_GET['editar']) && $_GET['editar']){
      echo "<p class='text-success'>Registro editado!</p>";
    } else if (isset($_GET['editar']) && !$_GET['editar']) {
      echo "<p class='text-danger'>Erro ao editar!</p>";
    }
    
    if (isset($_GET['excluir']) && $_GET['excluir']){
      echo "<p class='text-success'>Registro excluído!</p>";
    } else if (isset($_GET['excluir']) && !$_GET['excluir']) {
      echo "<p class='text-danger'>Erro ao excluir!</p>";
    }
?>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th colspan="3" style="color: black;">Dados registrados</th>
            <th class="no-print">
                <button style="color: black;" class="btn btn-secondary" onclick="window.print()">
                    Imprimir
                </button>
            </th>
        </tr>
        <tr>
            <th style="color: black; text-align: left;">Organizador (ID / Nome)</th>
            <th style="color: black; text-align: left;">Campeonato (ID / Nome)</th>
            <th style="color: black; text-align: left;">Partida (ID / Detalhes)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td>
                <b style="color: black;">ID:</b>
                <b style="color: black;"><?= $d['org_id'] ?></b>  
                <br>
                <b style="color: black;"><?= $d['org_nome'] ?></b> 
            </td>

            <td>
                <b style="color: black;">ID:</b> 
                <b style="color: black;"><?= $d['camp_id'] ?> </b> 
                <br>
                <b style="color: black;"><?= $d['camp_nome'] ?></b> 
            </td>

            <td>
                <b style="color: black;">ID:</b>
                <b style="color: black;"><?= $d['part_id'] ?></b> 
                <br>
                <b style="color: black;"><?= $d['time_casa'] ?></b>

                <strong style="color: black;"><?= $d['placar_casa'] ?></strong>
                <strong style="color: black;">x</strong> 
                <strong style="color: black;"><?= $d['placar_visitante'] ?></strong> 
                <b style="color: black;"><?= $d['time_visitante'] ?></b> 
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require("footer.php");
?>