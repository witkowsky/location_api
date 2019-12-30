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
     * @param string|null $text
     * @param int|null $distance
     *
     * @return array
     */
    public function findByTextAndDistance(?string $text = null, ?int $distance = null): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('l')
            ->from(Location::class, 'l');

        if ($text) {
            $qb->andWhere(
                $qb->expr()->orX(
                    'l.name LIKE :text',
                    'l.address LIKE :text'
                )
            );
            $qb->setParameter('text', '%' . $text . '%');
        }

        if ($distance) {
            $qb->andWhere('l.distance <= :distance');
            $qb->setParameter('distance', $distance);
        }

        return $qb->getQuery()->getResult();
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

    /**
     * @param bool $isHomePl
     * @return Location[]
     */
    public function findByHomePl(bool $isHomePl): array
    {
        return $this->findBy(['isHomePl' => $isHomePl]);
    }
}