<?php

namespace App\Domain;

use Miti\Validacao;

class CPF
{
    private $repo;
    private $number;
    
    public function __construct(CPFRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    public function setNumber(string $number): CPF
    {
        Validacao::cpf($number);
        $this->number = $number;
        
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function create(): bool
    {
        $this->checkDuplicate();
        return $this->repo->create($this);
    }
    
    private function checkDuplicate()
    {
        if ($this->repo->existsByNumber($this->number)) {
            throw new \Exception("The number {$this->number} already exists");
        }
    }

    public function find(int $id): CPF
    {
        return $this->repo->find($id);
    }
    
    public function findByNumber(string $number): CPF
    {
        return $this->repo->findByNumber($number);
    }
    
    public function existsByNumber(string $number): bool
    {
        return $this->repo->existsByNumber($number);
    }
    
    public function deleteByNumber(string $number): bool
    {
        return $this->repo->deleteByNumber($number);
    }
}
