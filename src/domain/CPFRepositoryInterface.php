<?php

namespace App\Domain;

interface CPFRepositoryInterface
{
    public function create(CPF $cpf);
    public function find(int $id): CPF;
    public function findByNumber(string $number): CPF;
    public function existsByNumber(string $number): bool;
    public function deleteByNumber(string $number): bool;
}
