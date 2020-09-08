<?php

namespace App\Service;


class CalculateToDaysService {


    public function calculate(int $years, int $months, int $days): int
    {
        $totalOfDays = $days +($years *365 ) + ($months * 30);

        return $totalOfDays;
    }

    
}
