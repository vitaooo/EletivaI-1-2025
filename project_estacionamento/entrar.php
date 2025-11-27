<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acesso - Estacionamento</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="body-in">
      <div class="login-card">
        <?php
      if (isset($_GET['cadastro'])) {
        $cadastro = $_GET['cadastro'];
        if ($cadastro) {
          echo "<p style='color: white;' >Cadastro realizado com sucesso!</p>";
        } else {
          echo '<p style="color: white;"  >Erro ao realizar o cadastro!</p>';
        }
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
            echo "<p class='text-danger' style='color: red; text-align: center;'>Credenciais inválidas!</p>";
          }
        }catch(\Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }

      ?>
        <h1 class="login-title">SISTEMA DE ESTACIONAMENTO </h1>
        <h2>Acesso ao Cliente</h2>

        <form  method="POST">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
              <button class="button-s" type="submit">Entrar</button>
        </form>

        <div class="footer">
            <p class="semconta">Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </div>
    </div>

</body>
</html>