<?php

namespace UnitTestFiles\Test;

use App\Service\ConvertTempService;
use PHPUnit\Framework\TestCase;

class TemperatureTest extends TestCase
{
    public function test_assert_conversion()
    {
        $service = new ConvertTempService();
        $result = $service->convert(36);
        
        $this->assertEquals(96.8, $result, 'Calculo de conversão de temperatura não está correto');
    }
}

