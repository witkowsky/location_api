<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Class DistanceCalculator
 * @package App\Service
 */
class DistanceCalculator implements DistanceCalculatorInterface
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
    public function calculate(float $fromLatitude, float $fromLongitude, float $toLatitude, float $toLongitude): float
    {
        if (($fromLatitude == $toLatitude) && ($fromLongitude == $toLongitude)) {
            return 0;
        }

        $theta = $fromLongitude - $toLongitude;
        $dist = sin(deg2rad($fromLatitude)) * sin(deg2rad($toLatitude))
            +  cos(deg2rad($fromLatitude)) * cos(deg2rad($toLatitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return round(($miles * 1.609344), 2);
    }
}
