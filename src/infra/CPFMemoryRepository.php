<?php

namespace App\Infra;

use App\Domain\CPFRepositoryInterface;

class CPFMemoryRepository implements CPFRepositoryInterface
{
    private $cpfs = [];

    public function create(string $cpf): bool
    {
        $this->cpfs[] = $cpf;
        return true;
    }
    
    public function find(string $cpf): string
    {
        foreach ($this->cpfs as $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                return $cpf;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf}");
    }
    
    public function exists(string $cpf): bool
    {
        foreach ($this->cpfs as $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                return true;
            }
        }
        
        return false;
    }
    
    public function delete(string $cpf): bool
    {
        foreach ($this->cpfs as $id => $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                unset($this->cpfs[$id]);
                return true;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf}");
    }
    
    public function countAll(): int
    {
        return count($this->cpfs);
    }
}
