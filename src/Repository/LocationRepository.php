<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;
use Doctrine\ORM\EntityRepository;

/**
 * Class LocationRepository
 * @package App\Repository
 */
class LocationRepository extends EntityRepository implements LocationRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Location|null
     */
    public function findById(int $id): ?Location
    {
        return $this->find($id);
    }

    /**
     * @param Location $location
     *
     * @return void
     */
    public function flush(Location $location): void
    {
        $this->getEntityManager()->persist($location);
        $this->getEntityManager()->flush($location);
    }
}