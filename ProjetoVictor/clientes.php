<?php
    require("cabecalho.php");
    require("conexao.php");

    try{
        $stmt = $pdo->query("SELECT * FROM clientes ORDER BY nome");
        $dados = $stmt->fetchAll();

    } catch(\Exception $e) {
        echo "Erro: ".$e->getMessage();
    }
?>
    
<h2>Cadastro de Clientes</h2>
<a href="novo_cliente.php" class="btn btn-success mb-3">Novo Cliente</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['nome'] ?></td>
            <td><?= $d['cpf'] ?></td>
            <td><?= $d['telefone'] ?></td>
            <td class="d-flex gap-2">
                <a href="#" class="btn btn-sm btn-warning">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        
<?php
    require("rodape.php");
?>