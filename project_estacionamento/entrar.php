<?php
// Lógica de Login (Mantida no topo para organização)
$mensagem_erro = "";
$mensagem_sucesso = "";

if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'true') {
    $mensagem_sucesso = "Cadastro realizado com sucesso! Faça seu login.";
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    require('conexao.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    try{
        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);  
        
        if($usuario && password_verify($senha, $usuario['senha'])){
            session_start();
            $_SESSION['acesso'] = true;
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            
            header('location: principal.php');
            exit(); 
        } else {
            $mensagem_erro = "E-mail ou senha incorretos!";
        }
    }catch(\Exception $e){
        $mensagem_erro = "Erro no sistema: ".$e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acesso - Estacionamento</title>
  <link rel="stylesheet" href="style.css">
  <style>
      /* Estilo extra apenas para mensagens de alerta */
      .alert-box {
          padding: 10px;
          margin-bottom: 15px;
          border-radius: 5px;
          font-size: 14px;
          text-align: center;
          font-weight: bold;
      }
      .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
      .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
  </style>
</head>

<body class="body-cas">

  <div class="fundo-carros">
    
    <div class="sombra-papel">
      
      <div class="papel-rasgado">
        
        <div class="login-content">
            
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 class="login-title" style="color: #36454f; font-size: 1.8rem;">
                    SISTEMA DE <br><span class="login-title-ev">ESTACIONAMENTO</span>
                </h1>
                <h2 class="header-subtitle" style="color: #6c8c7d; font-size: 1.1rem; margin-top: 5px;">
                    ÁREA DO CLIENTE
                </h2>
            </div>

            <?php if(!empty($mensagem_sucesso)): ?>
                <div class="alert-box alert-success"><?php echo $mensagem_sucesso; ?></div>
            <?php endif; ?>

            <?php if(!empty($mensagem_erro)): ?>
                <div class="alert-box alert-danger"><?php echo $mensagem_erro; ?></div>
            <?php endif; ?>

            <form method="POST">
                
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button class="button-s" type="submit">ENTRAR</button>
            </form>

            <div class="footer-cad" style="margin-top: 25px;">
                <p>Não tem uma conta? <a href="cadastro.php">Crie agora</a></p>
            </div>

        </div> </div> </div> </div> </body>
</html>