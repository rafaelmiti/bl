<?php

namespace App\Infra;

use App\Domain\CPF;

class CPFSessionFactory
{
    public function getInstance(): CPF
    {
        $repo = new CPFSessionRepository;
        $cpf = new CPF($repo);
        
        return $cpf;
    }
}
