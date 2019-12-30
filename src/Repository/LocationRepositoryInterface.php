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
     * @param string|null $text
     * @param int|null $distance
     *
     * @return array
     */
    public function findByTextAndDistance(?string $text = null, ?int $distance = null): array;

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

    /**
     * @param bool $isHomePl
     * @return Location[]
     */
    public function findByHomePl(bool $isHomePl): array;
}
