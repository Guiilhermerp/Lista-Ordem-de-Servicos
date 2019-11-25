<?php

// Crinando conexão com db
include './includes/dbc.php';

// Pegando o id da os
$id = $_GET['id'];

// Preparando a consulta
$query = $dbc->prepare("select
o.*,
	b.nome,
	t.nome
from (
oss o
	inner join bairros b on o.id_bairro=b.id
	inner join tipos_de_os t on o.id_tipo=t.id
)

WHERE o.id=:id;");

// Executando
$query->execute([':id' => $id]);

// Recuperando os dados
$os = $query->fetchAll(PDO::FETCH_ASSOC);

// Mostrando os dados
echo ('<pre>');
print_r($os);
echo ('</pre>');
die();
