<?php
    require("cabecalho.php");
    // require("conexao.php"); // Certifique-se de que este arquivo existe e conecta ao banco 'estacionamento_db'

    // Simulação de conexão caso você não tenha o arquivo pronto para testar
    if (!isset($pdo)) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamento_db", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            exit;
        }
    }

    try {
        // SQL Adaptado para o banco de estacionamento
        // Une Movimentação -> Veículo -> Cliente e Movimentação -> Vaga
        $sql = "SELECT 
                    m.id AS mov_id,
                    m.data_entrada,
                    m.data_saida,
                    m.valor_total,
                    v.placa,
                    v.modelo,
                    c.nome AS nome_cliente,
                    vg.codigo AS codigo_vaga,
                    vg.status AS status_vaga
                FROM movimentacao m
                INNER JOIN veiculo v ON m.veiculo_id = v.id
                INNER JOIN cliente c ON v.cliente_id = c.id
                INNER JOIN vaga vg ON m.vaga_id = vg.id
                ORDER BY m.id DESC";

        $stmt = $pdo->query($sql);
        $dados = $stmt->fetchAll();

    } catch(\Exception $e) {
        echo "<p class='text-danger'>Erro ao carregar dados: ".$e->getMessage() . "</p>";
        $dados = []; // Garante array vazio para não quebrar o foreach
    }

    // Mensagens de Feedback (Cadastro/Edição/Exclusão)
    if (isset($_GET['cadastro'])) {
        echo $_GET['cadastro'] ? "<p class='text-success'>Operação realizada com sucesso!</p>" : "<p class='text-danger'>Erro ao realizar operação!</p>";
    }
    if (isset($_GET['excluir'])) {
        echo $_GET['excluir'] ? "<p class='text-success'>Registro excluído!</p>" : "<p class='text-danger'>Erro ao excluir!</p>";
    }
?>

<!-- CONTEÚDO DA IMAGEM (Texto Promocional) -->
<section style="margin-bottom: 30px;">
    <h2 style="color: #4a6356; margin-bottom: 10px;">Estacionamento Inteligente: Escolha sua vaga automotiva.</h2>
    <p style="font-size: 1.1rem; line-height: 1.5; margin-bottom: 15px;">
        Imagine que, ao invés de buscar ansiosamente por uma vaga em um estacionamento lotado, 
        você pudesse escolher e reservar seu espaço com a mesma facilidade e antecedência que seleciona uma poltrona nos cinemas.
    </p>
    <p style="font-size: 1.1rem; line-height: 1.5;">
        Essa é a proposta dos <strong>Sistemas de Estacionamento Inteligente</strong> com reserva de vagas e 
        reconhecimento automático de placas, que combinam conveniência digital e automação para transformar a experiência de estacionar.
    </p>
</section>

<!-- TABELA DE DADOS (Substituindo a antiga tabela de campeonatos) -->
<div style="background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 style="color: #4a6356;">Movimentações Recentes</h3>
        <button class="btn btn-secondary" onclick="window.print()">
            <i class="fa-solid fa-print"></i> Imprimir Relatório
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Vaga</th>
                <th>Veículo (Placa / Modelo)</th>
                <th>Cliente</th>
                <th>Entrada</th>
                <th>Saída / Status</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($dados) > 0): ?>
                <?php foreach($dados as $d): ?>
                <tr>
                    <td>
                        <b style="font-size: 1.2rem;"><?= $d['codigo_vaga'] ?></b>
                    </td>
                    
                    <td>
                        <b><?= strtoupper($d['placa']) ?></b><br>
                        <small><?= $d['modelo'] ?></small>
                    </td>

                    <td>
                        <?= $d['nome_cliente'] ?>
                    </td>

                    <td>
                        <?= date('d/m/Y H:i', strtotime($d['data_entrada'])) ?>
                    </td>

                    <td>
                        <?php if ($d['data_saida']): ?>
                            <?= date('d/m/Y H:i', strtotime($d['data_saida'])) ?>
                        <?php else: ?>
                            <span style="color: green; font-weight: bold;">EM USO</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($d['valor_total']): ?>
                            R$ <?= number_format($d['valor_total'], 2, ',', '.') ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        Nenhuma movimentação registrada no momento.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Fechamento da div container aberta no cabecalho -->
</div> 
</body>
</html>