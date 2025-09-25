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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 22rem;">
      <h3 class="text-center mb-4">Acesso ao Sistema</h3>
      <form>
        <div class="mb-3">
          <label for="emailLogin" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="emailLogin" placeholder="Digite seu e-mail" required>
        </div>
        <div class="mb-3">
          <label for="senhaLogin" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senhaLogin" placeholder="Digite sua senha" required>
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
