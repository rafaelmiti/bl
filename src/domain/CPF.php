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
        return $this->repo->create($this->getNumber());
    }
    
    private function checkDuplicate()
    {
        if ($this->repo->exists($this->getNumber())) {
            throw new \Exception("The number {$this->number} already exists");
        }
    }

    public function find(): string
    {
        return $this->repo->find($this->getNumber());
    }
    
    public function exists(): bool
    {
        return $this->repo->exists($this->getNumber());
    }
    
    public function delete(): bool
    {
        return $this->repo->delete($this->getNumber());
    }
    
    public function countAll(): int
    {
        return $this->repo->countAll();
    }
}
