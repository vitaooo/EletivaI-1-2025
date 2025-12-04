<?php
require("cabecalho.php");
require("conexao.php");

// Busca todos os professores
$dados = $pdo->query("SELECT * FROM professor ORDER BY nome ASC")->fetchAll();
?>

<div class="header-flex">
    <h2 style="color: var(--primary-dark);">Corpo Docente</h2>
    <a href="novo_professor.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Novo Professor</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'sucesso'): ?>
        <div class="alert" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Professor cadastrado!
        </div>
    <?php elseif ($_GET['msg'] == 'editado'): ?>
        <div class="alert" style="background: #cce5ff; color: #004085; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Professor atualizado!
        </div>
    <?php elseif ($_GET['msg'] == 'excluido'): ?>
        <div class="alert" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            Professor removido.
        </div>
    <?php endif; ?>
<?php endif; ?>

<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Especialidade</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><strong><?= $d['nome'] ?></strong></td>
                <td><span style="background: #e2e6ea; padding: 2px 8px; border-radius: 4px;"><?= $d['especialidade'] ?></span></td>
                <td style="text-align: center;">
                    <a href="editar_professor.php?id=<?= $d['id'] ?>" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-pen"></i> Editar
                    </a>
                    <a href="consultar_professor.php?id=<?= $d['id'] ?>" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-eye"></i> Consultar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>