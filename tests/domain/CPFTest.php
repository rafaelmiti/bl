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
    
    public function testFind()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $cpf = $cpf->find();
        
        $this->assertSame($number, $cpf);
    }
    
    public function testNotFind()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number);
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("There is NO CPF with the number $number");
        
        $cpf->find();
    }
    
    public function testExists()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $exists = $cpf->exists();
        
        $this->assertTrue($exists);
    }
    
    public function testNotExists()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $exists = $cpf->setNumber($number)->exists();
        
        $this->assertFalse($exists);
    }
    
    public function testDelete()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number)->create();
        
        $exists = $cpf->exists();
        $this->assertTrue($exists);
        
        $cpf->delete();
        
        $exists = $cpf->exists();
        $this->assertFalse($exists);
    }
    
    public function testNotDelete()
    {
        $number = '48809715020';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        $cpf->setNumber($number);
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("There is NO CPF with the number $number");
        
        $cpf->delete();
    }

    public function testCountZero()
    {
        $cpf = (new CPFMemoryFactory)->getInstance();
        $this->assertSame(0, $cpf->countAll());
    }
    
    public function testCountAll()
    {
        $number1 = '48809715020';
        $number2 = '17405298044';
        $number3 = '26961545033';
        
        $cpf = (new CPFMemoryFactory)->getInstance();
        
        $cpf->setNumber($number1)->create();
        $cpf->setNumber($number2)->create();
        $cpf->setNumber($number3)->create();
        
        $this->assertSame(3, $cpf->countAll());
    }
}
