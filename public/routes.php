<?php

use App\Infra\CPFMemoryFactory;

router($_GET['r'], '/\/cpf\/[0-9]{11}/', function(){
    $number = explode('/', $_GET['r'])[2];
    
    $cpf = (new CPFMemoryFactory)->getInstance();
    $exists = $cpf->existsByNumber($number);
    
    response(['cpf' => $number, 'blocked' => $exists]);
});

router($_GET['r'], '/\/cpf\/block/', function(){
    if (empty($_POST['cpf'])) response(['message' => 'Não há CPF']);
    
    $number = $_POST['cpf'];
    
    $cpf = (new CPFMemoryFactory)->getInstance();
    $cpf->setNumber($number)->create();
    
    response(['message' => 'CPF bloqueado!']);
});
