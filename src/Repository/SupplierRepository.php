<?php

namespace App\Repository;

use App\Entity\Item;
use App\Entity\Supplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Supplier>
 */
class SupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supplier::class);
    }

    /**
     * @return Supplier[]
     */
    public function fetchAll(): array
    {
        return $this->createQueryBuilder('s')
            ->select('s.name','s.address', 's.email', 's.website', 's.country', 's.phone')
            ->getQuery()
            ->getResult();
    }

    public function deleteAll(): void
    {
        $this->createQueryBuilder('s')->delete()->getQuery()->execute();
    }
}
