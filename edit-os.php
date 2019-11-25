<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php 
        include "./includes/dbc.php";

        $id = $_GET['$id'];

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
        $os = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <form action="" method="post">
        <input type="text" name="" id="" value="<?=$os[0]['endereco']?>">
    </form>
</body>

</html>