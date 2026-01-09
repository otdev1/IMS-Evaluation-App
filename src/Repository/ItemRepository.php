<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * @return Item[]
     */
    public function fetchAll(): array
    {
        return $this->createQueryBuilder('i')
            ->select('s.name as supplier, i.sku, i.description, i.heightInCm, i.widthInCm, i.lengthInCm, i.weightInKg, i.cost')
            ->join('i.supplier', 's')
            ->getQuery()
            ->getResult();
    }

    public function deleteAll(): void
    {
        $this->createQueryBuilder('i')->delete()->getQuery()->execute();
    }
}
