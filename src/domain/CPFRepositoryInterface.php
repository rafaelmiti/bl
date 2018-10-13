<?php

namespace App\Domain;

interface CPFRepositoryInterface
{
    public function create(string $cpf);
    public function find(string $cpf): string;
    public function exists(string $cpf): bool;
    public function delete(string $cpf): bool;
    public function countAll(): int;
}
