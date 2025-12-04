<?php
    require("cabecalho.php");
    require("conexao.php");

    try {
        // Query consolidada (antigo resumo.php)
        $sql = "SELECT 
                    m.id as mat_id,
                    m.data_inicio,
                    a.nome as aluno_nome,
                    p.nome as prof_nome,
                    pl.nome as plano_nome,
                    pl.valor
                FROM matricula m
                INNER JOIN aluno a ON m.aluno_id = a.id
                INNER JOIN professor p ON m.professor_id = p.id
                INNER JOIN plano pl ON m.plano_id = pl.id
                ORDER BY m.id DESC LIMIT 10";

        $stmt = $pdo->query($sql);
        $dados = $stmt->fetchAll();

        // Contadores para o dashboard
        $total_alunos = $pdo->query("SELECT count(*) FROM aluno")->fetchColumn();
        $total_matriculas = $pdo->query("SELECT count(*) FROM matricula")->fetchColumn();

    } catch(\Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>

<h2 style="color: #333;">Dashboard da Academia</h2>
<div style="display: flex; gap: 20px; margin-bottom: 30px;">
    <div style="background: var(--primary-color); color: white; padding: 20px; border-radius: 10px; flex: 1;">
        <h3><?= $total_alunos ?></h3>
        <p>Alunos Cadastrados</p>
    </div>
    <div style="background: var(--primary-dark); color: white; padding: 20px; border-radius: 10px; flex: 1;">
        <h3><?= $total_matriculas ?></h3>
        <p>Matrículas Ativas</p>
    </div>
</div>

<div class="header-flex">
    <h3>Últimas Matrículas Registradas</h3>
    <button class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> Imprimir Relatório</button>
</div>

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Professor</th>
            <th>Plano</th>
            <th>Valor</th>
            <th>Início</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td>#<?= $d['mat_id'] ?></td>
            <td style="font-weight: bold;"><?= $d['aluno_nome'] ?></td>
            <td><?= $d['prof_nome'] ?></td>
            <td><span style="background: #e7f1ff; color: #007bff; padding: 3px 8px; border-radius: 4px;"><?= $d['plano_nome'] ?></span></td>
            <td>R$ <?= number_format($d['valor'], 2, ',', '.') ?></td>
            <td><?= date('d/m/Y', strtotime($d['data_inicio'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>