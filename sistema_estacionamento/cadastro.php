<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro da Empresa</title>
</head>

<body class="body-cas">

  <div class="fundo-carros">
    
    <div class="sombra-papel">
      
      <div class="papel-rasgado">
        
        <div class="login-content">
            <div style="text-align: center; margin-bottom: 20px;">
               <h1 class="login-title" style="color: #36454f;">S P R I N T <span class="login-title-ev">E V E N T O S</span> </h1>
               <h2 class="header-subtitle" style="color: #6c8c7d; font-size: 1.2rem;">CADASTRO DE EMPRESA</h2>
            </div>

            <form method="POST" action="">

              <div class="input-group">
                <label for="nome">Nome da empresa:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome" required>
              </div>

              <div class="input-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" required>
              </div>

              <div class="input-group">
                <label for="inscricao">Inscrição Estadual:</label>
                <input type="text" id="inscricao" name="inscricao" placeholder="Isento ou número">
              </div>

              <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="empresa@email.com" required>
              </div>

              <div class="input-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="(00) 00000-0000">
              </div>

              <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Crie sua senha" required>
              </div>

              <button type="submit" class="button-s">CADASTRAR</button>
              
              <div class="footer-cad">
                <p>ou <a href="index.php">ENTRAR</a></p>
              </div>
            </form>
            </div>
      </div>
    </div>
  </div>

</body>
</html>