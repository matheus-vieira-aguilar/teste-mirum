<?php

namespace App\Service;


class ConvertTempService {


    public function convert(float $given_temperature): float
    {
        $fahrenheit = $given_temperature * 9 / 5 + 32;

        return $fahrenheit;
    }

    
}