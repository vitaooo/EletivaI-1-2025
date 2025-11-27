<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("conexao.php");

    // Verifica se os campos obrigatórios foram enviados
    if(isset($_POST['nome']) && isset($_POST['cnpj']) && isset($_POST['email']) && isset($_POST['senha'])) {
        
        $nome = $_POST['nome'];
        $cnpj = $_POST['cnpj']; // Vamos salvar o CNPJ na coluna 'cpf' do banco
        $telefone = $_POST['telefone']; // Novo campo que adicionamos no banco
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        
        // OBS: O campo 'inscricao_estadual' está no HTML para seguir a imagem, 
        // mas como não existe no banco, não vamos incluí-lo no INSERT para evitar erros.

        try {
            // MUDANÇA: Inserindo na tabela 'cliente' do novo banco estacionamento_db
            $stmt = $pdo->prepare("INSERT INTO cliente (nome, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?)");
            
            if ($stmt->execute([$nome, $cnpj, $telefone, $email, $senha])) {
                header("location: entrar.php?cadastro=true");
                exit(); 
            } else {
                header("location: cadastro.php?cadastro=false");
                exit();
            }
        } catch (PDOException $e) {
            // Tratamento específico para erro de duplicidade (CNPJ ou Email já cadastrados)
            if ($e->getCode() == 23000) {
                echo "<script>alert('Erro: CNPJ ou E-mail já cadastrados!'); window.location.href='cadastro.php';</script>";
            } else {
                echo "Erro no Banco de Dados: " . $e->getMessage();
            }
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
  <title>Cadastro da Empresa</title>
</head>

<body class="body-cas">

  <div class="login-card"> 
    
    <div style="width: auto; background-color: #36454f; padding: 20px; border-radius: 15px; text-align: center; margin-bottom: 20px;">
      

    </div>
    <form method="POST" action="">

      <div class="input-group">
        <label for="nome">Nome da empresa:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome da empresa" required>
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
      <p style="text-align: center; margin-top: 25px; font-size: 14px; color: #36454f; text-decoration: underline #36454f;">ou</p>
      <div class="footer" style="margin-top: 10px;">
        <p> <a href="entrar.php" style="display: inline-block; margin-top: 5px; text-decoration: none; border: 1px solid #6c8c7d; padding: 5px 20px; border-radius: 15px; color: #6c8c7d;">ENTRAR</a></p>
      </div>
    </form>

    
  </div>
  <div class="secao_imagem">
                <img src="img/carros-login.png" class="corredor" alt="">
    </div>
</body>
</html>