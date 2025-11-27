<?php
session_start();
require("conexao.php");

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['acesso'] = true;
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome']; 
            
            header("Location: principal.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos!";
        }
    } catch (Exception $e) {
        $erro = "Erro no sistema: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vehicle Safety</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="body-in">

    <div class="fundo-carros">
        <div class="papel-rasgado">
            
            <div class="login-content">
                <h1 style="font-family: 'Migra Extrabold', sans-serif; color: var(--header-dark); font-size: 2.5rem; margin-bottom: 10px;">
                    Vehicle Safety
                </h1>
                <p style="margin-bottom: 30px; font-weight: bold; color: #666;">GESTÃO DE ESTACIONAMENTO</p>

                <?php if($erro): ?>
                    <div class="alert alert-danger" style="margin-bottom: 20px;">
                        <i class="fa-solid fa-triangle-exclamation"></i> <?= $erro ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="seu@email.com">
                    </div>

                    <div class="input-group" style="margin-top: 20px;">
                        <label>Senha</label>
                        <input type="password" name="senha" required placeholder="******">
                    </div>

                    <button type="submit" class="button-s">ENTRAR</button>
                </form>

                <div class="footer-cad">
                    Não tem conta? <a href="cadastro.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>