<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Dto\Location as LocationDto;

/**
 * Class LocationDtoBuilder
 * @package App\Service
 */
class LocationDtoBuilder implements LocationDtoBuilderInterface
{
    /**
     * @param Location[] $locations
     *
     * @return LocationDto[]
     */
    public function buildFromArray(array $locations): array
    {
        return array_map('build', $locations);
    }

    /**
     * @param Location $location
     *
     * @return LocationDto
     */
    public function build(Location $location): LocationDto
    {
        return new LocationDto(
            $location->getId(),
            $location->getName(),
            $location->getAddress(),
            $location->getLatitude(),
            $location->getLongitude()
        );
    }
}