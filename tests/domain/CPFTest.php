<?php

use PHPUnit\Framework\TestCase;

use App\Domain\CPF;
use App\Infra\CPFMemoryFactory;

class CPFTest extends TestCase
{
    public function testNotValidNumber()
    {
        $number = '12345678901';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('#4 O CPF é inválido');
        
        $cpf->setNumber($number);
    }
    
    public function testDuplicatedNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("The number $number already exists");
        
        $cpf->create();
    }
    
    public function testFindById()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $numberFromRepo = $cpf->find(0)->getNumber();
        
        $this->assertSame($number, $numberFromRepo);
    }
    
    public function testNotFindById()
    {
        $number = '48809715020';
        $key = 1;
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("There is NO CPF for the key $key");
        
        $cpf->find($key)->getNumber();
    }
    
    public function testFindByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $cpf = $cpf->findByNumber($number);
        
        $this->assertInstanceOf(CPF::class, $cpf);
    }
    
    public function testNotFindByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("There is NO CPF with the number $number");
        
        $cpf->findByNumber($number);
    }
    
    public function testExistsByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $exists = $cpf->existsByNumber($number);
        
        $this->assertTrue($exists);
    }
    
    public function testNotExistsByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $exists = $cpf->existsByNumber($number);
        
        $this->assertFalse($exists);
    }
    
    public function testDeleteByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $exists = $cpf->existsByNumber($number);
        $this->assertTrue($exists);
        
        $cpf->deleteByNumber($number);
        
        $exists = $cpf->existsByNumber($number);
        $this->assertFalse($exists);
    }
    
    public function testNotDeleteByNumber()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("There is NO CPF with the number $number");
        
        $cpf->deleteByNumber($number);
    }
}
