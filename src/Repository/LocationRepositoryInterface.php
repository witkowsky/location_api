<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;

/**
 * Interface LocationRepositoryInterface
 * @package App\Repository
 */
interface LocationRepositoryInterface
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

    /**
     * @param Location $location
     *
     * @return void
     */
    public function flush(Location $location): void;

    /**
     * @param int $id
     *
     * @return void
     */
    public function remove(int $id): void;
}
