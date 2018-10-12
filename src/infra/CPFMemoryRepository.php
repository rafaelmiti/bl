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
    
    public function find(int $id): CPF
    {
        $this->checkCpfExistence($id);
        return $this->cpfs[$id];
    }
    
    private function checkCpfExistence(int $id)
    {
        if (!$this->cpfs[$id] instanceof CPF) {
            throw new \Exception("There is NO CPF for the key $id");
        }
    }

    public function findByNumber(string $number): CPF
    {
        foreach ($this->cpfs as $cpf) {
            if ($cpf->getNumber() === $number) {
                return $cpf;
            }
        }
        
        throw new \Exception("There is NO CPF with the number $number");
    }
    
    public function existsByNumber(string $number): bool
    {
        foreach ($this->cpfs as $cpf) {
            if ($cpf->getNumber() === $number) {
                return true;
            }
        }
        
        return false;
    }
    
    public function deleteByNumber(string $number): bool
    {
        foreach ($this->cpfs as $id => $cpf) {
            if ($cpf->getNumber() === $number) {
                unset($this->cpfs[$id]);
                return true;
            }
        }
        
        throw new \Exception("There is NO CPF with the number $number");
    }
}
