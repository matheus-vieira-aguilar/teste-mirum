<?php

namespace App\Service;


class CalculationService {

    const MINIMOAPROVADO = 7;

    public function calcularNotas(array $notas): string
    {
        $ammount = array_sum($notas);

        if ($ammount >= self::MINIMOAPROVADO) {
            return 'APROVADO';
        }

        return 'REPROVADO';
    }

    
}