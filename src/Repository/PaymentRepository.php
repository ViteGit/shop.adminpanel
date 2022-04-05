<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    /**
     * @param int $invId
     *
     * @return Payment
     *
     * @throws EntityNotFoundException
     */
    public function getByInvId(int $invId): Payment
    {
        $payment = $this->findOneBy(['invId' => $invId]);

        if (empty($payment)) {
            throw new EntityNotFoundException("Транзакция с invId = $invId не найдена");
        }

        return $payment;
    }
}
