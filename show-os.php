<?php

// Crinando conexão com db
include './includes/dbc.php';

// Pegando o id da os
$id = $_GET['id'];

// Preparando a consulta
$query = $dbc->prepare("SELECT
o.*,
	b.nome,
	t.nome
FROM (
oss o
	INNER JOIN bairros b ON o.id_bairro=b.id
	INNER JOIN tipos_de_os t ON o.id_tipo=t.id
)

WHERE o.id=:id;");

// Executando
$query->execute([':id' => $id]);

// Recuperando os dados
$os = $query->fetchAll(PDO::FETCH_ASSOC)[0];

// Query equipes
$queryEquipe = $dbc->prepare("SELECT 
                                e.id,
                                e.nome
                                FROM (
                                oss_equipes oe
                                INNER JOIN equipes e ON oe.id_equipe=e.id
                            ) WHERE id_os =:id");

$queryEquipe->execute([':id'=>$id]);

$equipes = $queryEquipe->fetchAll(PDO::FETCH_ASSOC);

$query = $dbc->prepare("SELECT
                        o.*,
                            b.nome,
                            t.nome
                        FROM (
                        oss o
                            INNER JOIN bairros b ON o.id_bairro=b.id
                            INNER JOIN tipos_de_os t ON o.id_tipo=t.id
                        ) WHERE o.id=:id;");

                        //Executando a consulta preparada
                        $query->execute([
                            ':id' => $id]);

                        //Capturando o resultado da minha consulta [só a primeira linha]    
                        $os = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                        

// Preparar a consulta para levantar os bairros
$query = $dbc->prepare("SELECT id, nome FROM bairros");

// Executando a consulta
$query->execute();

// Capturar o resultado da consulta
$bairros = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <!-- Inputs com as informações -->
                <div class="form-group">
                    <label for="endereco">Rua</label>
                    <input type="text" class="form-control" name="" id="endereco" aria-describedby="helpId" value="<?=$os['endereco']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <select class="form-control" name="" id="bairro" readonly>
                        <?php foreach ($bairros as $bairro): ?>
                            <option <?= $bairro['id'] == $os['id_bairro'] ? 'selected' : '' ?> value="<?=$bairro['id']?>"><?=$bairro['nome']?></option>
                        <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <label for="duracao_prev">Duração Prevista</label>
                    <input type="text" class="form-control" name="" id="duracao_prev" aria-describedby="helpId" value="<?=$os['duracao_prev']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="duracao_real">Duração Real</label>
                    <input type="text" class="form-control" name="" id="duracao_real" aria-describedby="helpId" value="<?=$os['duracao_real']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="n" class="form-control" name="" id="valor" aria-describedby="helpId" value="<?=$os['valor']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="text" class="form-control" name="" id="data" aria-describedby="helpId" value="<?=$os['data']?>" readonly> 
                </div>

                <div class="form-group">
                    <label for="nomeOS">Tipo de OS</label>
                    <input disable type="text" class="form-control" name="" id="nomeOS" aria-describedby="helpId" value="<?=$os['nome']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="equipe">Equipe responsável</label>
                        <?php foreach($equipes as $equipe): ?>
                            <input disable type="text" class="form-control" name="" id="equipe" aria-describedby="helpId" value="<?=$equipe['nome']?>" readonly>
                        <?php endforeach; ?>
                </div>
                
                <!-- FORMULARIO PARA BOTAO DE EXCLUSAO e EDICAO-->
                
                <a href="edit-os.php?id=<?= $id ?>"><button class="btn btn-primary float-right" type="submit">Editar</button></a>
                <form action="./includes/delete-os.php" method="post">
                    <input type="hidden" value="<?= $id ?>" name="id_os">
                    <button class="mr-2 btn btn-primary float-right" type="submit">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>