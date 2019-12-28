<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Location as LocationDto;
use App\Entity\Location;

/**
 * Interface LocationDtoBuilderInterface
 * @package App\Service
 */
interface LocationDtoBuilderInterface
{
    /**
     * @param Location[] $locations
     *
     * @return LocationDto[]
     */
    public function buildFromArray(array $locations): array;

    /**
     * @param Location $location
     *
     * @return LocationDto
     */
    public function build(Location $location): LocationDto;
}