<?php
    
    $user = 'root';
    $senha = '';
    $porta = 3307;
    $dbname = 'osmakers';
    $host = 'localhost';

    //Definição de string de conexão    
    $dsn = "mysql:host=$host:$porta;dbname=$dbname;charset=utf8mb4";

    // Instanciando um Objeto que sera o DB
    $dbc = new PDO($dsn, $user, $senha);   

    // // Preparação da consulta
    // $query = $dbc->prepare("SELECT * FROM oss WHERE id=:id");

    // //Execução da consulta 
    // $query->execute([':id' => 3]);

    // $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // print_r($results);
?>