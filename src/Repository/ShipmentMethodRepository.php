<?php

namespace App\Repository;

use App\Entity\ShipmentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShipmentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShipmentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShipmentMethod[]    findAll()
 * @method ShipmentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentMethodRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShipmentMethod::class);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getAll(): array
    {
        $methods = $this->findBy(['status.value' => true]);

        if (empty($methods)) {
            throw new EntityNotFoundException('Доставка в системе пока отсутствует, нужно добавить, хотябы один способ доставки');
        }

        return $methods;
    }
}
