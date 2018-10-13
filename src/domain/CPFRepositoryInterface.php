<?php

namespace App\Domain;

interface CPFRepositoryInterface
{
    public function create(CPF $cpf);
    public function find(CPF $cpf): CPF;
    public function exists(CPF $cpf): bool;
    public function delete(CPF $cpf): bool;
}
