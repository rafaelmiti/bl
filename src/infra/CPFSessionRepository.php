<?php

namespace App\Infra;

use App\Domain\CPFRepositoryInterface;

class CPFSessionRepository implements CPFRepositoryInterface
{
    public function create(string $cpf): bool
    {
        $_SESSION['cpfs'][] = $cpf;
        return true;
    }
    
    public function find(string $cpf): string
    {
        foreach ($_SESSION['cpfs'] as $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                return $cpf;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf}");
    }
    
    public function exists(string $cpf): bool
    {
        foreach ($_SESSION['cpfs'] as $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                return true;
            }
        }
        
        return false;
    }
    
    public function delete(string $cpf): bool
    {
        foreach ($_SESSION['cpfs'] as $id => $cpfFromRepo) {
            if ($cpfFromRepo === $cpf) {
                unset($_SESSION['cpfs'][$id]);
                return true;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf}");
    }
    
    public function countAll(): int
    {
        return count($_SESSION['cpfs']);
    }
}
