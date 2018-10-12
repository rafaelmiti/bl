<?php

use PHPUnit\Framework\TestCase;
use App\CPF;

class CPFTest extends TestCase
{
    public function testCreate()
    {
        $cpf = new CPF('12345678901');
        $this->assertTrue($cpf->create());
    }
}
