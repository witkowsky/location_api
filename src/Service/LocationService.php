<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Repository\LocationRepositoryInterface;

/**
 * Class LocationService
 * @package App\Service
 */
class LocationService
{
    /**
     * @var LocationRepositoryInterface
     */
    private $repository;

    /**
     * LocationService constructor.
     * @param LocationRepositoryInterface $repository
     */
    public function __construct(LocationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $name
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     *
     * @return int
     */
    public function createLocation(string $name, string $address, float $latitude, float $longitude): int
    {
        $location = new Location($name, $address, $latitude, $longitude);
        $this->repository->flush($location);

        return $location->getId();
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     *
     * @return void
     */
    public function updateLocation(
        int $id,
        string $name,
        string $address,
        float $latitude,
        float $longitude
    ): void {
        $location = $this->repository->findById($id);

        if (!$location) {
            throw new \InvalidArgumentException(sprintf('Location %s not found'));
        }

        $location->setName($name);
        $location->setAddress($address);
        $location->setLatitude($latitude);
        $location->setLongitude($longitude);

        $this->repository->flush($location);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function removeLocation(int $id): void
    {
        $this->repository->remove($id);
    }
}