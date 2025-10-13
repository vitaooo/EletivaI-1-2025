<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require("conexao.php");

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];

        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, telefone) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $cpf, $telefone]);
            
            // Redireciona para a listagem com mensagem de sucesso
            header("Location: clientes.php?cadastro=sucesso");

        } catch (\Exception $e) {
            // Em caso de erro, pode redirecionar com uma mensagem de erro
            header("Location: clientes.php?cadastro=erro");
            // die("Erro ao salvar cliente: " . $e->getMessage());
        }
    } else {
        // Se não for POST, redireciona para a página principal
        header("Location: principal.php");
    }
?>