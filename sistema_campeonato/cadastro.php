<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("conexao.php");
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("INSERT INTO organizador (nome, email, senha) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$nome, $email, $senha])) {
                header("location: entrar.php?cadastro=true");
                exit(); 
            } else {
              
                header("location: index.php?cadastro=false");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro no Banco de Dados: " . $e->getMessage();
            exit(); 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Usuário</title>
</head>

<body class="body-cas">
  <div class="card-sprint">
    <h1 class="login-title">S P R I N T <span class="login-title-ev">E V E N T O S</span> </h1>
    <h2 class="header-subtitle">Cadastro</h2>

    <form method="POST" action="">

      <div class="input-group">
        <label for="nome" class="label-pill">Nome:</label>
        <input type="text" id="nome" name="nome" class="input-field" placeholder="nome completo" required>
      </div>

      <div class="input-group">
        <label for="email" class="label-pill">E-mail:</label>
        <input type="email" id="email" name="email" class="input-field" placeholder="teste@gmail.com" required>
      </div>

      <div class="input-group">
        <label for="senha" class="label-pill">Senha:</label>
        <input type="password" id="senha" name="senha" class="input-field" placeholder="senha" required>
      </div>

      <button type="submit" class="btn-salvar">Cadastrar</button>

      <div class="footer">
        <p class="semconta">Já tem conta? <a href="entrar.php">Entre aqui!</a></p>
      </div>

    </form>
  </div>
</body>
</html>