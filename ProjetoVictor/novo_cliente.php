<?php require("cabecalho.php"); ?>

<h2>Novo Cliente</h2>

<form action="salvar_cliente.php" method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require("rodape.php"); ?>