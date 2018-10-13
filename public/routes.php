<?php

use App\Infra\CPFSessionFactory;

session_start();
if (empty($_SESSION['cpfs'])) $_SESSION['cpfs'] = [];

router($_GET['r'], '/\/cpf\/[0-9]{11}/', function(){
    $number = explode('/', $_GET['r'])[2];
    
    $cpf = (new CPFSessionFactory)->getInstance();
    $exists = $cpf->setNumber($number)->exists();
    
    response(['cpf' => $number, 'blocked' => $exists]);
});

router($_GET['r'], '/\/cpf\/block/', function(){
    if (empty($_POST['cpf'])) response(['message' => 'Não há CPF']);
    
    $number = $_POST['cpf'];
    
    $cpf = (new CPFSessionFactory)->getInstance();
    $cpf->setNumber($number)->create();
    
    response(['message' => 'CPF bloqueado!']);
});

router($_GET['r'], '/\/cpf\/free/', function(){
    if (empty($_POST['cpf'])) response(['message' => 'Não há CPF']);
    
    $number = $_POST['cpf'];
    
    $cpf = (new CPFSessionFactory)->getInstance();
    $cpf->setNumber($number)->delete();
    
    response(['message' => 'CPF liberado!']);
});
