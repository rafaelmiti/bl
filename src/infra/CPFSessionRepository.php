<?php

namespace App\Infra;

use App\Domain\CPFRepositoryInterface;
use App\Domain\CPF;

class CPFSessionRepository implements CPFRepositoryInterface
{
    public function create(CPF $cpf): bool
    {
        $_SESSION['cpfs'][] = $cpf;
        return true;
    }
    
    public function find(CPF $cpf): CPF
    {
        foreach ($_SESSION['cpfs'] as $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                return $cpf;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf->getNumber()}");
    }
    
    public function exists(CPF $cpf): bool
    {
        foreach ($_SESSION['cpfs'] as $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                return true;
            }
        }
        
        return false;
    }
    
    public function delete(CPF $cpf): bool
    {
        foreach ($_SESSION['cpfs'] as $id => $cpfFromRepo) {
            if ($cpfFromRepo->getNumber() === $cpf->getNumber()) {
                unset($_SESSION['cpfs'][$id]);
                return true;
            }
        }
        
        throw new \Exception("There is NO CPF with the number {$cpf->getNumber()}");
    }
}
