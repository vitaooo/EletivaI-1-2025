<?php
/*require("conexao.php");
    if($pdo){
        echo "<h1>Conexão realizada com sucesso!</h1>";
    }*/
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acesso ao Sistema</title>
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
          $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
          $stmt->execute([$email]);
          $usuario = $stmt->fetch(PDO::FETCH_ASSOC);  
          if($usuario && password_verify($senha, $usuario['senha'])){
            session_start();
            $_SESSION['acesso'] = true;
            $_SESSION['nome'] = $usuario['nome'];
            
            header('location: principal.php');
          } else {
            echo "<p class='text-danger'>Credenciais inválidas!</p>";
          }
        }catch(\Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }

      ?>
        <h1 class="login-title">E V O <span class="login-title-ev">F I T</span> </h1>
        <h2 style="color:white; text-align:center;">Acesso ao Sistema</h2>

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