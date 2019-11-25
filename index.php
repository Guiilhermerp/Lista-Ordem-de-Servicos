<?php
   include './includes/dbc.php';

    // Preparação da consulta
    $query = $dbc->prepare("SELECT 
                                o.id,
                                o.endereco,
                                b.nome AS nomeBairro,
                                t.nome AS tipoDeOS 
                            FROM (
                                oss o
                                INNER JOIN bairros b ON o.id_bairro=b.id
                                INNER JOIN tipos_de_os t ON o.id_tipo=t.id
                            ) ORDER BY o.id;
                            ");

    //Execução da consulta 
    $query->execute();
    $oss = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <title>Lista Ordem de Serviços</title>
</head>
<body>
    <div class="container">
    <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Endereço</th>
      <th scope="col">Bairro</th>
      <th scope="col">Tipo</th>
      <th scope="col">Ação</th> 
      <th scope="col"><a href="create-os.php" class="btn btn-secondary">Nova OS</a></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($oss as $os ): ?>
    <tr>
      <th scope="row"><?=$os['id']?></th>
      <td><?=$os['endereco']?></td>
      <td><?=$os['nomeBairro']?></td>
      <td><?=$os['tipoDeOS']?></td>
      <td><a href="show-os.php?id=<?=$os['id']?>" class="btn btn-secondary">Ver</a></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>