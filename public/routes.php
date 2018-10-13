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
        if (empty($_POST['cpf'])) response(['message' => 'Não há CPF para ser bloqueado']);

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
        if (empty($_POST['cpf'])) response(['message' => 'Não há CPF para ser liberado']);

        $number = $_POST['cpf'];

        $cpf = (new CPFSessionFactory)->getInstance();
        $cpf->setNumber($number)->delete();

        response(['message' => 'CPF liberado!']);
    } catch (\Exception $e) {
        response(['message' => $e->getMessage()]);
    }
});

router($_GET['r'], '/\/status/', function(){
    try{
        $str   = @file_get_contents('/proc/uptime');
        $num   = floatval($str);
        $secs  = round(fmod($num, 60)); $num = (int)($num / 60);
        $mins  = $num % 60;             $num = (int)($num / 60);
        $hours = $num % 24;             $num = (int)($num / 24);
        $days  = $num;
        
        $cpf = (new CPFSessionFactory)->getInstance();
        $count = $cpf->countAll();

        response([
            'blacklist_count' => $count,
            'server_uptime' => "{$days}d {$hours}h {$mins}m {$secs}s"
        ]);
    } catch (\Exception $e) {
        response(['message' => $e->getMessage()]);
    }
});

response(['message' => 'Nenhuma rota para responder']);
