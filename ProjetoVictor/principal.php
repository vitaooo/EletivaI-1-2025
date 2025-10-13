<?php
    require("cabecalho.php");
    require("conexao.php");

    // Lógica para registrar SAÍDA
    if (isset($_GET['saida_registro_id'])) {
        $registro_id = $_GET['saida_registro_id'];
        
        // Pega a data de entrada para calcular o valor (exemplo simples)
        $stmt_entrada = $pdo->prepare("SELECT data_entrada, vaga_id FROM registros WHERE id = ?");
        $stmt_entrada->execute([$registro_id]);
        $registro = $stmt_entrada->fetch();
        $data_entrada = new DateTime($registro['data_entrada']);
        $data_saida = new DateTime();
        
        $intervalo = $data_entrada->diff($data_saida);
        $horas = $intervalo->h + ($intervalo->days * 24);
        $valor_hora = 10.00; // Exemplo: R$10 por hora
        $valor_pago = ($horas < 1) ? $valor_hora : $horas * $valor_hora;

        // Atualiza o registro com a data de saída e valor
        $stmt_saida = $pdo->prepare("UPDATE registros SET data_saida = NOW(), valor_pago = ? WHERE id = ?");
        $stmt_saida->execute([$valor_pago, $registro_id]);

        // Libera a vaga
        $stmt_vaga = $pdo->prepare("UPDATE vagas SET status = 'disponivel' WHERE id = ?");
        $stmt_vaga->execute([$registro['vaga_id']]);
        
        echo "<p class='alert alert-success'>Saída do veículo registrada com sucesso!</p>";
    }


    // Lógica para registrar ENTRADA
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['veiculo_id'])) {
        $veiculo_id = $_POST['veiculo_id'];
        $vaga_id = $_POST['vaga_id'];

        // Insere o novo registro
        $stmt_entrada = $pdo->prepare("INSERT INTO registros (veiculo_id, vaga_id, data_entrada) VALUES (?, ?, NOW())");
        $stmt_entrada->execute([$veiculo_id, $vaga_id]);

        // Atualiza o status da vaga para 'ocupada'
        $stmt_vaga = $pdo->prepare("UPDATE vagas SET status = 'ocupada' WHERE id = ?");
        $stmt_vaga->execute([$vaga_id]);
        
        echo "<p class='alert alert-success'>Entrada de veículo registrada com sucesso!</p>";
    }

    // Consultas para exibir dados na página
    try {
        // Veículos estacionados (sem data de saída)
        $stmt_estacionados = $pdo->query("
            SELECT r.id, v.placa, vg.codigo, r.data_entrada, c.nome as cliente_nome
            FROM registros r
            JOIN veiculos v ON r.veiculo_id = v.id
            JOIN vagas vg ON r.vaga_id = vg.id
            JOIN clientes c ON v.cliente_id = c.id
            WHERE r.data_saida IS NULL
            ORDER BY r.data_entrada ASC
        ");
        $veiculos_estacionados = $stmt_estacionados->fetchAll(PDO::FETCH_ASSOC);

        // Veículos e vagas disponíveis para o formulário de entrada
        $stmt_veiculos_disponiveis = $pdo->query("SELECT id, placa FROM veiculos");
        $veiculos_disponiveis = $stmt_veiculos_disponiveis->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt_vagas_disponiveis = $pdo->query("SELECT id, codigo FROM vagas WHERE status = 'disponivel'");
        $vagas_disponiveis = $stmt_vagas_disponiveis->fetchAll(PDO::FETCH_ASSOC);

    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
?>

<div class="card mb-4">
    <div class="card-header">
        <h3>Registrar Nova Entrada</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="principal.php">
            <div class="row">
                <div class="col-md-5">
                    <label for="veiculo_id" class="form-label">Veículo (Placa)</label>
                    <select name="veiculo_id" id="veiculo_id" class="form-select" required>
                        <option value="">Selecione um veículo</option>
                        <?php foreach($veiculos_disponiveis as $veiculo): ?>
                            <option value="<?= $veiculo['id'] ?>"><?= $veiculo['placa'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="vaga_id" class="form-label">Vaga Disponível</label>
                    <select name="vaga_id" id="vaga_id" class="form-select" required>
                        <option value="">Selecione uma vaga</option>
                         <?php foreach($vagas_disponiveis as $vaga): ?>
                            <option value="<?= $vaga['id'] ?>"><?= $vaga['codigo'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<h2>Veículos Estacionados</h2>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Placa</th>
            <th>Cliente</th>
            <th>Vaga</th>
            <th>Data/Hora de Entrada</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($veiculos_estacionados as $veiculo): ?>
        <tr>
            <td><?= $veiculo['placa'] ?></td>
            <td><?= $veiculo['cliente_nome'] ?></td>
            <td><?= $veiculo['codigo'] ?></td>
            <td><?= date('d/m/Y H:i:s', strtotime($veiculo['data_entrada'])) ?></td>
            <td>
                <a href="principal.php?saida_registro_id=<?= $veiculo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar saída deste veículo?')">Registrar Saída</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require("rodape.php");
?>