<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method getById($id)
 */
class OrderRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @param string $uniqueId
     *
     * @return Cart
     *
     * @throws NonUniqueResultException
     */
    public function findByUniqueId(string $uniqueId): ?Order
    {
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.uniqueId = :uniqueId')
            ->setParameter(':uniqueId', $uniqueId)
            ->getQuery()
            ->getOneOrNullResult();

        return $order;
    }

    /**
     * @param int $id
     * @return Cart|null
     * @throws EntityNotFoundException
     */
    public function getByOrderId(int $id)
    {
        $order = $this->findOneBy(['orderId' => $id]);

        if (empty($order)) {
            throw new EntityNotFoundException("Заказ с orderId = $id не найден");
        }

        return $order;
    }
}
