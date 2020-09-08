<?php

namespace App\Controller;

use App\Service\CalculateToDaysService;
use App\Service\CalculationService;
use App\Service\ConvertTempService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculationController extends AbstractController {

    const TEMPLATEBASE = 'calculations/';
    public $calculationService;

    public function __construct(CalculationService $calculationService)
    {
        $this->calculationService = $calculationService;
    }

    /**
     * @Route("/calcula-notas/{nota1}/{nota2}/{nota3}/{nota4}")
     */
    public function calculaNotas(int $nota1, int $nota2, int $nota3, int $nota4) : Response
    {
        $result = $this->calculationService->calcularNotas([ $nota1, $nota2, $nota3, $nota4 ]);
        
        return $this->render(self::TEMPLATEBASE . 'result.html.twig', [
            'result' => $result
        ]);
    }

    /**
     * @Route("/calcula-temperatura/{temp}")
     */
    public function calculaTemperatura(float $temp, ConvertTempService $convertTempService) : Response
    {
        $result = $convertTempService->convert($temp);
        
        return $this->render(self::TEMPLATEBASE . 'result.html.twig', [
            'result' => $result
        ]);
    }

    /**
     * @Route("/calcula-idade/{years}/{months}/{days}")
     */
    public function calculaIdade(int $years, int $months, int $days, CalculateToDaysService $calculateToDaysService): Response
    {
        $result = $calculateToDaysService->calculate($years, $months,$days);
        
        return $this->render(self::TEMPLATEBASE . 'result.html.twig', [
            'result' => $result
        ]);
    }
}