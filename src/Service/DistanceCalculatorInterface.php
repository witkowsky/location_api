<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Class DistanceCalculator
 * @package App\Service
 */
interface DistanceCalculatorInterface
{
    /**
     * Calculate distance in KM
     *
     * @param float $fromLatitude
     * @param float $fromLongitude
     * @param float $toLatitude
     * @param float $toLongitude
     *
     * @return float
     */
    public function calculate(float $fromLatitude, float $fromLongitude, float $toLatitude, float $toLongitude): float;
}