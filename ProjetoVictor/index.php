<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reserva do Estacionamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 22rem;">
      <?php
      if (isset($_GET['cadastro'])) {
        $cadastro = $_GET['cadastro'];
        if ($cadastro) {
          echo "<p class='text-success'>Cadastro realizado com sucesso!</p>";
        } else {
          echo '<p class="text-danger">Erro ao realizar o cadastro!</p>';
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

            $sttt = $pdo->prepare("SELECT * FROM veiculo WHERE id = ?");
            $sttt->execute([ $usuario['veiculo_id'] ]); 
            $veiculo = $sttt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['acesso'] = true;
            $_SESSION['nome'] = $usuario['nome'];

            if ($veiculo) {
              $_SESSION['placa'] = $veiculo['placa'];
              $_SESSION['modelo'] = $veiculo['modelo'];
            }
            
            header('location: principal.php');
            exit;
          } else {
            echo "<p class='text-danger'>Credenciais inválidas!</p>";
          }
        }catch(\Exception $e){
          echo "Erro: ".$e->getMessage();
        }
      }

      ?>
      <h2 class="text-center mb-4">Acesso ao Estacionamento</h2>
      <form method="POST" action="index.php">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>
      <div class="text-center mt-3">
        <small>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></small>
      </div>
    </div>
  </div>

</body>

</html>