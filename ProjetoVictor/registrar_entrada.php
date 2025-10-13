<?php
// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Coletar e validar os dados do formulário
    $placa = isset($_POST['placa']) ? trim($_POST['placa']) : '';
    $modelo = isset($_POST['modelo']) ? trim($_POST['modelo']) : '';
    $data_entrada = date('Y-m-d H:i:s'); // Pega a data e hora atual

    // Validação simples (em um projeto real, seria mais robusta)
    if (empty($placa)) {
        die("Erro: A placa é obrigatória.");
    }

    // 2. Conectar ao banco de dados
    /*
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "estacionamento_db";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    */

    // 3. Inserir os dados no banco de dados
    /*
    $sql = "INSERT INTO veiculos (placa, modelo, data_entrada) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $placa, $modelo, $data_entrada);

    if ($stmt->execute()) {
        // Sucesso
    } else {
        // Erro
        echo "Erro ao registrar: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
    */

    // 4. Redirecionar de volta para a página principal
    // Em um projeto real, você adicionaria uma mensagem de sucesso (usando sessões)
    header("Location: index.php");
    exit();

} else {
    // Se alguém tentar acessar este arquivo diretamente, redireciona
    header("Location: index.php");
    exit();
}
?>