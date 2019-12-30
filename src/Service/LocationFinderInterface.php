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
     * @param string|null $text
     * @param int|null $distance
     *
     * @return Location[]
     */
    public function findByTextAndDistance(?string $text = null, ?int $distance = null): array;
}