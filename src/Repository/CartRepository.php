<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    /**
     * @param string $uniqueId
     *
     * @return Cart
     *
     * @throws NonUniqueResultException
     */
    public function findByUniqueId(string $uniqueId): ?Cart
    {
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.uniqueId = :uniqueId')
            ->setParameter(':uniqueId', $uniqueId)
            ->getQuery()
            ->getOneOrNullResult();

        return $order;
    }
}
