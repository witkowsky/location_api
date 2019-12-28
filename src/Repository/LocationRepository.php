<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;
use Doctrine\ORM\EntityRepository;
use InvalidArgumentException;

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
     * @param string $text
     * @param int $distance
     *
     * @return Location[]
     */
    public function findByTextAndDistance(?string $text, ?int $distance): array
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT l FROM App\Entity\Location l WHERE (l.name LIKE :text OR l.address LIKE :text)");

        $query->setParameters(array(
            'text' => '%' . $text . '%',
        ));

        return  $query->getResult();
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

    /**
     * @param int $id
     *
     * @return void
     */
    public function remove(int $id): void
    {
        $location = $this->findById($id);

        if (!$location) {
            throw new InvalidArgumentException(sprintf('Location %s not found.', $id));
        }

        $this->getEntityManager()->remove($location);
        $this->getEntityManager()->flush();
    }
}