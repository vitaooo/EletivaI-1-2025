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
      <form>
        <div class="mb-3">
          <label for="nomeCadastro" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nomeCadastro" placeholder="Digite seu nome" required>
        </div>
        <div class="mb-3">
          <label for="emailCadastro" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="emailCadastro" placeholder="Digite seu e-mail" required>
        </div>
        <div class="mb-3">
          <label for="senhaCadastro" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senhaCadastro" placeholder="Crie uma senha" required>
        </div>
        <div class="mb-3">
          <label for="confirmaSenha" class="form-label">Confirme a Senha</label>
          <input type="password" class="form-control" id="confirmaSenha" placeholder="Confirme sua senha" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Cadastrar</button>
      </form>
      <div class="text-center mt-3">
        <small>Já possui conta? <a href="index.php">Entrar aqui</a></small>
      </div>
    </div>
  </div>

</body>
</html>
