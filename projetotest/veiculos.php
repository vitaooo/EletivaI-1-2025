<?php
    require("cabecalho.php");
    require("conexao.php");

    try{
        $stmt = $pdo->query("SELECT * FROM veiculo");
        $dados = $stmt->fetchAll();

    } catch(\Exception $e) {
        echo "Erro: ".$e->getMessage();
    }

    if (isset($_GET['cadastro']) && $_GET['cadastro']){
        echo "<p clas=='text-success'>Veículo cadastrado!</p>";
    } else if (isset($_GET['cadastro']) && !$_GET['cadastro']) {
        echo "<p class='text-danger'>Erro ao cadastrar veículo!</p>";
    }

    if (isset($_GET['editar']) && $_GET['editar']){
      echo "<p clas=='text-success'>Registro editado!</p>";
    } else if (isset($_GET['editar']) && !$_GET['editar']) {
      echo "<p class='text-danger'>Erro ao editar!</p>";
    }
    if (isset($_GET['excluir']) && $_GET['excluir']){
      echo "<p clas=='text-success'>Veículo excluída!</p>";
    } else if (isset($_GET['excluir']) && !$_GET['excluir']) {
      echo "<p class='text-danger'>Erro ao excluir veículo!</p>";
    }
?>

    
<h2>Veículo</h2>
          <a href="novo_veiculo.php" class="btn btn-success mb-3">Registrar novo veículo</a>
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Placa</th>
                <th>Modelo</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($dados as $d): 
                ?>
                <tr>
                  <td><?= $d['placa'] ?></td>
                  <td><?= $d['modelo'] ?></td>
                  <td class="d-flex gap-2">
                    <a href="editar_veiculo.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="consultar_veiculo.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                  </td>
                </tr>
                <?php 
                    endforeach; 
                ?>
            </tbody>
          </table>
        

<?php
    require("rodape.php");
?>