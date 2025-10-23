<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 25rem;">
      <h3 class="text-center mb-4">Cadastro de Usuário</h3>
      <form method="POST">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha">
        </div>

        <div class="mb-3">
          <label for="placa" class="form-label">Placa</label>
          <input type="text" class="form-control" id="placa" name="placa" placeholder="Informe a placa do seu veiculo">
        </div>

        <div class="mb-3">
          <label for="veiculo" class="form-label">Modelo do Veículo</label>
          <input type="text" class="form-control" id="veiculo" name="veiculo" placeholder="Informe o modelo do seu veiculo">
        </div>

        <button type="submit" class="btn btn-success w-100">Cadastrar</button>
      </form>
      <div class="text-center mt-3">
        <small>Já possui conta? <a href="index.php">Entrar aqui</a></small>
      </div>
    </div>
  </div>

  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      require("conexao.php");
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

      $modelo = $_POST['veiculo'];
      $placa = $_POST['placa'];

      $pdo->beginTransaction();

      try{
        //inserir veiculo
        $stmt_veiculo = $pdo->prepare("INSERT INTO veiculo (modelo, placa) VALUES (?, ?)");
        $stmt_veiculo->execute([$modelo, $placa]);

        // obter o id do veículo inserido
        $veiculo_id = $pdo->lastInsertId();

        //inserir cliente
        $stmt_cliente = $pdo->prepare("INSERT INTO cliente (nome, email, senha, veiculo_id) VALUES (?, ?, ?, ?)");

          if($stmt_cliente->execute([$nome, $email, $senha, $veiculo_id])){
            $pdo->commit();
            header("location: index.php?cadastro=true");
          } else {
            $pdo->rollback();
            header("location: index.php?cadastro=false");
          }
      } catch(Exception $e){
        echo "Erro ao executar o comando SQL: ".$e->getMessage();
      }

    }
  
  ?>

</body>
</html>
