<?php

namespace App\Repository;


use App\Entity\PickPointZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PickPointZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method PickPointZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method PickPointZone[]    findAll()
 * @method PickPointZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickPointZoneRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PickPointZone::class);
    }
}
