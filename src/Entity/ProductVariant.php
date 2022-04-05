<?php

namespace App\Entity;

use App\DTO\StockData;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductVariantRepository")
 */
class ProductVariant
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $aId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $barcode;

    /**
     * @var StockData | null
     *
     * @ORM\Embedded(class="App\DTO\StockData", columnPrefix=false)
     */
    private $stockData;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productVariants")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @param int $aId
     * @param string $barcode
     * @param string $color
     * @param string $size
     * @param StockData $stockData
     */
    public function __construct(
        int $aId,
        string $barcode,
        ?string $color = null,
        ?string $size = null,
        ?StockData $stockData = null
    ) {
        $this->aId = $aId;
        $this->barcode = $barcode;
        $this->color = $color;
        $this->size = $size;
        $this->stockData = $stockData;
    }

    /**
     * @return string
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return int
     */
    public function getAId(): int
    {
        return $this->aId;
    }

    /**
     * @return StockData|null
     */
    public function getStockData(): ?StockData
    {
        return $this->stockData;
    }

    /**
     * @param StockData|null $stockData
     */
    public function setStockData(?StockData $stockData): void
    {
        $this->stockData = $stockData;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return ProductVariant
     */
    public function updateProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param StockData $stockData
     *
     * @return ProductVariant
     */
    public function updateStockData(StockData $stockData): self
    {
        $this->stockData = $stockData;

        return $this;
    }
}
