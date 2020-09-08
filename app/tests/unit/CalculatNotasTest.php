<?php

namespace UnitTestFiles\Test;

use App\Service\CalculationService;
use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function test_assert_reprovado()
    {
        $service = new CalculationService();
        $result = $service->calcularNotas([1, 1, 1, 1]);
        
        $this->assertEquals('REPROVADO', $result, 'Se a nota final for menor que 7 deve retornar REPROVADO');
    }

    public function test_assert_aprovado()
    {
        $service = new CalculationService();
        $result = $service->calcularNotas([1, 2, 4, 10]);
        
        $this->assertEquals('APROVADO', $result, 'Se a nota final for maior que 7 deve retornar APROVADO');
    }
}

