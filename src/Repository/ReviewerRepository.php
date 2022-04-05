<?php

namespace App\Repository;

use App\Entity\Reviewer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reviewer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reviewer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reviewer[]    findAll()
 * @method Reviewer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewerRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reviewer::class);
    }
}
