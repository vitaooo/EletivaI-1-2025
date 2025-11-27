<?php
require("cabecalho.php");
require("conexao.php");

try {
    $stmt = $pdo->query("SELECT * FROM cliente ORDER BY id DESC");
    $dados = $stmt->fetchAll();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}

// Mensagens omitidas para brevidade, mas funcionam igual
?>

<div class="header-flex">
    <h2>Gestão de Clientes</h2>
    <a href="novo_cliente.php" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Novo Cliente
    </a>
</div>

<table class="styled-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Email</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $d): ?>
            <tr>
                <td><?= $d['nome'] ?></td>
                <td><?= $d['cpf'] ?></td>
                <td><?= $d['telefone'] ?></td>
                <td><?= $d['email'] ?></td>
                <td style="text-align: center; display: flex; gap: 5px; justify-content: center;">
                    <a href="editar_cliente.php?id=<?= $d['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <!-- Botão Consultar Adicionado -->
                    <a href="consulta_cliente.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require("footer.php"); ?>