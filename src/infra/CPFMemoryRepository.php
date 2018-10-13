<?php

namespace App\Infra;

use App\Domain\CPFRepositoryInterface;
use App\Domain\CPF;

class CPFMemoryRepository implements CPFRepositoryInterface
{
    private $cpfs = [];

    public function create(CPF $cpf): bool
    {
        $this->cpfs[] = $cpf;
        return true;
    }
    
    public function find(CPF $cpf): CPF
    {
        foreach ($this->cpfs as $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                return $cpf;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf->getNumber()}");
    }
    
    public function exists(CPF $cpf): bool
    {
        foreach ($this->cpfs as $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                return true;
            }
        }
        
        return false;
    }
    
    public function delete(CPF $cpf): bool
    {
        foreach ($this->cpfs as $id => $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                unset($this->cpfs[$id]);
                return true;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf->getNumber()}");
    }
}
