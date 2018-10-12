<?php

namespace App\Infra;

use App\Domain\CPF;

class CPFMemoryFactory
{
    public function getInstance(): CPF
    {
        $repo = new CPFMemoryRepository;
        $cpf = new CPF($repo);
        
        return $cpf;
    }
}
