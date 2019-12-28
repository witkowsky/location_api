<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Location;

/**
 * Class LocationFinder
 *
 * @package App\Service
 */
interface LocationFinderInterface
{
    /**
     * @param int $id
     *
     * @return Location|null
     */
    public function findById(int $id): ?Location;

    /**
     * @param string $text
     * @param int $distance
     *
     * @return Location[]
     */
    public function findByTextAndDistance(string $text, int $distance): array;
}