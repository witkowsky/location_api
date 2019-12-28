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
     * @param Location $location
     *
     * @return void
     */
    public function flush(Location $location): void;
}
