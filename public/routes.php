<?php

use App\Infra\CPFSessionFactory;

session_start();
if (empty($_SESSION['cpfs'])) $_SESSION['cpfs'] = [];

router($_GET['r'], '/\/cpf\/[0-9]{11}/', function(){
    try{
        $number = explode('/', $_GET['r'])[2];

        $cpf = (new CPFSessionFactory)->getInstance();
        $exists = $cpf->setNumber($number)->exists();

        response(['cpf' => $number, 'blocked' => $exists]);
    } catch (\Exception $e) {
        response(['message' => $e->getMessage()]);
    }
});

router($_GET['r'], '/\/cpf\/block/', function(){
    try{
        if (empty($_POST['cpf'])) response(['message' => 'Não há CPF']);

        $number = $_POST['cpf'];

        $cpf = (new CPFSessionFactory)->getInstance();
        $cpf->setNumber($number)->create();

        response(['message' => 'CPF bloqueado!']);
    } catch (\Exception $e) {
        response(['message' => $e->getMessage()]);
    }
});

router($_GET['r'], '/\/cpf\/free/', function(){
    try{
        if (empty($_POST['cpf'])) response(['message' => 'Não há CPF']);

        $number = $_POST['cpf'];

        $cpf = (new CPFSessionFactory)->getInstance();
        $cpf->setNumber($number)->delete();

        response(['message' => 'CPF liberado!']);
    } catch (\Exception $e) {
        response(['message' => $e->getMessage()]);
    }
});
