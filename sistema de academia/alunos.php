<?php
require("cabecalho.php");
require("conexao.php");

// Busca todos os alunos
$dados = $pdo->query("SELECT * FROM aluno ORDER BY id DESC")->fetchAll();
?>

<div class="header-flex">
    <h2 style="color: var(--primary-dark);">Gestão de Alunos</h2>
    <a href="novo_aluno.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Novo Aluno</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'sucesso'): ?>
        <div class="alert" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Aluno cadastrado com sucesso!
        </div>
    <?php elseif ($_GET['msg'] == 'editado'): ?>
        <div class="alert" style="background: #cce5ff; color: #004085; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Dados do aluno atualizados!
        </div>
    <?php elseif ($_GET['msg'] == 'excluido'): ?>
        <div class="alert" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Aluno excluído do sistema.
        </div>
    <?php endif; ?>
<?php endif; ?>

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Idade</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d): 
            // Cálculo simples de idade
            $idade = "N/A";
            if($d['data_nascimento']) {
                $hoje = new DateTime();
                $nasc = new DateTime($d['data_nascimento']);
                $idade = $hoje->diff($nasc)->y . " anos";
            }
        ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><strong><?= $d['nome'] ?></strong></td>
                <td><?= $d['email'] ?></td>
                <td><?= $idade ?></td>
                <td style="text-align: center;">
                    <a href="editar_aluno.php?id=<?= $d['id'] ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-pen"></i> Editar
                    </a>
                    <a href="consultar_aluno.php?id=<?= $d['id'] ?>" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-eye"></i> Consultar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>