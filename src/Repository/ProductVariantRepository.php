<?php

namespace App\Repository;

use App\Entity\ProductVariant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method ProductVariant|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductVariant|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductVariant[]    findAll()
 * @method ProductVariant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductVariantRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductVariant::class);
    }


    /**
     * @param int $id
     *
     * @return ProductVariant
     */
    public function getById(int $id): ProductVariant
    {
        $productVariant  = $this->findOneBy(['id' => $id]);

        if (empty($productVariant)) {
            throw new NotFoundHttpException("товар с id = $id не найден");
        }

        return $productVariant;
    }

    /**
     * @param string $barcode
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByBarcode(string $barcode): ?array
    {
        $productVariants = $this->createQueryBuilder('v')
            ->andWhere('v.barcode = :barcode')
            ->setParameter(':barcode', $barcode)
            ->getQuery()
            ->getResult();

        return $productVariants;
    }
}