<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Location;
use App\Repository\LocationRepositoryInterface;

/**
 * Class LocationFinder
 * @package App\Service
 */
class LocationFinder implements LocationFinderInterface
{
    /**
     * @var LocationDtoBuilderInterface
     */
    private $locationDtoBuilder;

    /**
     * @var LocationRepositoryInterface
     */
    private $locationRepository;

    /**
     * LocationFinder constructor.
     * @param LocationDtoBuilderInterface $locationDtoBuilder
     * @param LocationRepositoryInterface $locationRepository
     */
    public function __construct(
        LocationDtoBuilderInterface $locationDtoBuilder,
        LocationRepositoryInterface $locationRepository
    ) {
        $this->locationDtoBuilder = $locationDtoBuilder;
        $this->locationRepository = $locationRepository;
    }

    /**
     * @param int $id
     *
     * @return Location|null
     */
    public function findById(int $id): ?Location
    {
        $location = $this->locationRepository->findById($id);
        return $location ? $this->locationDtoBuilder->build($location) : null;
    }

    /**
     * @param string $text
     * @param int $distance
     *
     * @return Location[]
     */
    public function findByTextAndDistance(string $text, int $distance): array
    {
        return $this->locationDtoBuilder
            ->buildFromArray($this->locationRepository->findByTextAndDistance($text, $distance));
    }
}