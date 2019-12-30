<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Repository\LocationRepositoryInterface;
use InvalidArgumentException;

/**
 * Class LocationService
 * @package App\Service
 */
class LocationService implements LocationServiceInterface
{
    /**
     * @var LocationRepositoryInterface
     */
    private $repository;

    /**
     * @var DistanceCalculatorInterface
     */
    private $distanceCalculator;

    /**
     * LocationService constructor.
     * @param LocationRepositoryInterface $repository
     * @param DistanceCalculatorInterface $distanceCalculator
     */
    public function __construct(
        LocationRepositoryInterface $repository,
        DistanceCalculatorInterface $distanceCalculator
    ) {
        $this->repository = $repository;
        $this->distanceCalculator = $distanceCalculator;
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

        $this->updateDistance($location);

        return $location->getId();
    }

    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $address
     * @param float|null $latitude
     * @param float|null $longitude
     *
     * @return void
     */
    public function updateLocation(
        int $id,
        ?string $name,
        ?string $address,
        ?float $latitude,
        ?float $longitude
    ): void {
        $location = $this->repository->findById($id);

        if (!$location) {
            throw new InvalidArgumentException(sprintf('Location %s not found', $id));
        }

        if ($name) {
            $location->setName($name);
        }

        if ($address) {
            $location->setAddress($address);
        }

        if ($latitude) {
            $location->setLatitude($latitude);
        }

        if ($longitude) {
            $location->setLongitude($longitude);
        }

        $this->repository->flush($location);

        $this->updateDistance($location);
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

    /**
     * @param Location $location
     */
    private function updateDistance(Location $location): void
    {
        if ($location->isHomePl()) {
            $homePl = $location;
            $locations = $this->repository->findByHomePl(false);
        } else {
            $locations = [];
            $locations[] = $location;
            $homePl = current($this->repository->findByHomePl(true));
        }

        /** @var Location $homePl */
        foreach ($locations as $location) {
            $distance = $this->distanceCalculator->calculate(
                $homePl->getLatitude(),
                $homePl->getLongitude(),
                $location->getLatitude(),
                $location->getLongitude()
            );
            $location->setDistance($distance);
            $this->repository->flush($location);
        }
    }
}