<?php

namespace App\Repository;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\ProductVariant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param int $id
     *
     * @return Product
     */
    public function getById(int $id): Product
    {
        $product = $this->findOneBy(['id' => $id]);

        if (empty($product)) {
            throw new NotFoundHttpException("товар с id = $id не найден");
        }

        return $product;
    }

    /**
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function getBestSellerProducts(int $limit, int $offset): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin(ProductVariant::class, 'pv', 'with', 'p.id = pv.product')
            ->innerJoin(CartItem::class, 'ci', 'with', 'pv.id = ci.productVariant')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $categoryIds
     * @param string|null $vendor
     *
     * @param bool|null $bestseller
     * @return int
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFilteredLinesCount(
        array $categoryIds = [],
        ?string $vendor = null,
        ?bool $bestseller = null
    ): int {
        $builder = $this->getFilteredLinesQuery(
            $this->getEntityManager()
                ->createQueryBuilder()
                ->select('COUNT(p)')
                ->from(Product::class, 'p'),
            $categoryIds,
            $vendor,
            $bestseller
        );

        $result = $builder->getQuery()->getSingleScalarResult();

        return $result ?? 0;
    }

    /**
     * @param QueryBuilder $builder
     * @param array $categoryIds
     * @param string|null $vendor
     * @param bool|null $bestseller
     * @return QueryBuilder
     */
    private function getFilteredLinesQuery(
        QueryBuilder $builder,
        array $categoryIds = [],
        ?string $vendor = null,
        ?bool $bestseller = null
    ): QueryBuilder
    {
//        $builder
//            ->andWhere('p.active = :active')
//            ->setParameter('active', true);

        if (!empty($categoryIds)) {
            $builder->leftJoin('p.categories', 'c')
                ->andWhere('c.id in (:categoryIds)')
                ->setParameter(':categoryIds', $categoryIds);
        }

        if (!empty($vendor)) {
            $builder->andWhere('p.vendor = :vendor')
                ->setParameter(':vendor', $vendor);
        }

        if (!empty($bestseller)) {
            $builder->innerJoin(ProductVariant::class, 'pv', 'with', 'p.id = pv.product')
                ->innerJoin(CartItem::class, 'ci', 'with', 'pv.id = ci.productVariant');
        }

        return $builder;
    }

    /**
     * @param int|null $rating
     * @param bool $enStock
     * @param bool|null $discount
     * @param int | null $limit
     * @param int | null $offset
     * @param array $categoryIds
     * @param string|null $vendor
     * @param bool|null $bestseller
     * @param string $sort
     * @param string $order
     *
     * @return array | Product[]
     */
    public function findByFilters(
        ?int $rating = null,
        ?bool $enStock = null,
        ?bool $discount = null,
        ?int $limit = null,
        ?int $offset = null,
        array $categoryIds = [],
        ?string $vendor = null,
        ?bool $bestseller = null,
        $sort = 'id',
        $order = 'ASC'
    ) {
        $builder = $this->getFilteredLinesQuery(
            $this->createQueryBuilder('p'),
            $categoryIds,
            $vendor,
            $bestseller
        );

        if (!empty($rating)) {
            $builder->andWhere('p.rating = :rating')
                ->setParameter(':rating', $rating);
        }

        if (null !== $enStock) {
            $builder->andWhere('p.enStock = :enStock')
                ->setParameter(':enStock', $enStock);
        }

        if (null !== $discount) {
            $builder->andWhere('p.discount != 0');
        }

        if (!empty($offset)) {
            $builder->setFirstResult($offset);
        }

        if (!empty($limit)) {
            $builder->setMaxResults($limit);
        }

        $builder->orderBy("p.$sort", $order);

        return $builder->getQuery()->getResult();
    }

}