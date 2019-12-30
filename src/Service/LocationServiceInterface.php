<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Class LocationService
 * @package App\Service
 */
interface LocationServiceInterface
{
    /**
     * @param string $name
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     *
     * @return int
     */
    public function createLocation(string $name, string $address, float $latitude, float $longitude): int;

    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $address
     * @param float|null $latitude
     * @param float|null $longitude
     *
     * @return void
     */
    public function updateLocation(int $id, ?string $name, ?string $address, ?float $latitude, ?float $longitude): void;

    /**
     * @param int $id
     *
     * @return void
     */
    public function removeLocation(int $id): void;
}