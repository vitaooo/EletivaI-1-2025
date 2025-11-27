<?php
require("conexao.php");

$cliente = null;
$erro_msg = null; // Variável para guardar erros de exclusão

// 1. Processa Exclusão (LÓGICA VEM PRIMEIRO)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE id = ?");
        if ($stmt->execute([$id])) {
            header('location: clientes.php?excluir=true');
            exit;
        } else {
            header('location: clientes.php?excluir=false');
            exit;
        }
    } catch (\Exception $e) {
        // Se der erro (ex: tem carro vinculado), guardamos a mensagem para exibir depois do cabeçalho
        $erro_msg = "Erro ao excluir: O cliente possui veículos ou movimentações vinculadas.";
    }
}

// 2. Carrega dados do cliente (Para exibir no formulário)
// Verificamos se tem ID no GET (URL) ou se veio do POST (caso tenha dado erro na exclusão)
$id_busca = $_GET['id'] ?? $_POST['id'] ?? null;

if ($id_busca) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE id = ?");
        $stmt->execute([$id_busca]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erro ao consultar: " . $e->getMessage();
    }
}

// 3. AGORA SIM, carregamos o visual
require("cabecalho.php");
?>

<div style="margin-top: 20px;">
    <h1 style="color: black;">Consultar Cliente</h1>

    <?php 
    // Se houver mensagem de erro da exclusão, mostramos aqui
    if ($erro_msg) {
        echo "<div class='alert alert-danger'>$erro_msg</div>";
    }
    ?>

    <?php if($cliente): ?>
    <form method="post" style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
        <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label" style="color: black;">Nome</label>
            <input disabled value="<?= $cliente['nome'] ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: black;">CPF</label>
            <input disabled value="<?= $cliente['cpf'] ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: black;">Telefone</label>
            <input disabled value="<?= $cliente['telefone'] ?>" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: black;">Email</label>
            <input disabled value="<?= $cliente['email'] ?>" type="email" class="form-control">
        </div>

        <div class="alert alert-warning">
            <p style="color: black; margin: 0;">Deseja excluir esse registro permanentemente?</p>
        </div>

        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
    </form>
    <?php else: ?>
        <div class="alert alert-danger">Cliente não encontrado.</div>
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>
</div>

<?php
require("footer.php");
?>