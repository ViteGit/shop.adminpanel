<?php

namespace App\Entity;

use App\DTO\ProductCharacteristicsData;
use Doctrine\Common\Collections\ArrayCollection;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Id товара в системе оптовика (артикул)
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $prodId;

    /**
     * Артикул товара производителя
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $vendorCode;

    /**
     * Производитель
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10000)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $enStock;

    /**
     * @ORM\OneToMany(targetEntity="ProductVariant", mappedBy="product", cascade={"persist", "remove"})
     */
    private $productVariants;

    /**
     * @var ProductCharacteristicsData
     *
     * @ORM\Embedded(class="App\DTO\ProductCharacteristicsData", columnPrefix=false)
     */
    private $productCharacteristicsData;

    /**
     * @var Seo
     *
     * @ORM\OneToOne(targetEntity="Seo", cascade={"persist"})
     */
    private $seo;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createAt;

    /**
     * @var DateTimeImmutable | null
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updateAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * @ORM\JoinTable(name="product_category")
     */
    private $categories;

    /**
     * @var string
     */
    private $wholesaler = 'p5s';

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="product", cascade={"persist", "remove"})
     */
    private $reviews;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Image", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="product_image",
     *    joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $images;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @param int $prodId
     * @param string $vendorCode
     * @param string $vendor
     * @param string $name
     * @param string $description
     * @param float $price
     * @param ProductCharacteristicsData $characteristicsData
     * @param bool $enStock
     * @param int $discount
     * @param Seo|null $seo
     * @param array $productVariants
     * @param array $categories
     * @param array $images
     * @throws \Exception
     */
    public function __construct(
        int $prodId,
        string $vendorCode,
        string $vendor,
        string $name,
        string $description,
        float $price,
        ProductCharacteristicsData $characteristicsData,
        bool $enStock,
        int $discount,
        Seo $seo,
        array $productVariants = [],
        array $categories = [],
        array $images = []
    ) {
        $this->prodId = $prodId;
        $this->vendorCode = $vendorCode;
        $this->vendor = $vendor;
        $this->name = $name;
        $this->description = $description;
        $this->productCharacteristicsData = $characteristicsData;
        $this->seo = $seo;
        $this->price = $price;
        $this->enStock = $enStock;
        $this->productVariants = new ArrayCollection(array_unique($productVariants, SORT_REGULAR));
        $this->categories = new ArrayCollection(array_unique($categories, SORT_REGULAR));
        $this->reviews = new ArrayCollection();
        $this->createAt = new DateTimeImmutable();
        $this->images = new ArrayCollection(array_unique($images, SORT_REGULAR));
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return int
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param ProductVariant $productVariant
     *
     * @return Product
     */
    public function addProductVariant(ProductVariant $productVariant): self
    {
        $this->productVariants->add($productVariant);

        return $this;
    }

    /**
     * @param Review $review
     *
     * @return Product
     */
    public function addReview(Review $review): self
    {
        $this->reviews->add($review);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProdId(): int
    {
        return $this->prodId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }

    /**
     * @return ProductCharacteristicsData
     */
    public function getProductCharacteristicsData(): ProductCharacteristicsData
    {
        return $this->productCharacteristicsData;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdateAt(): DateTimeImmutable
    {
        return $this->updateAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreateAt(): DateTimeImmutable
    {
        return $this->createAt;
    }

    /**
     * @return Collection
     */
    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    /**
     * @return Seo
     */
    public function getSeo(): Seo
    {
        return $this->seo;
    }

    /**
     * @return string
     */
    public function getWholesaler(): string
    {
        return $this->wholesaler;
    }


    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return Image
     */
    public function getThumbnail(): string
    {
        $filteredCollection = $this->images->filter(function(Image $image) {
            return Image::THUMBNAIL === $image->getType();
        });

        $first = $filteredCollection->first();

        return empty($first) ? '/content/img/no-image.jpg' : $first->getPath();
    }

    /**
     * @return ArrayCollection
     */
    public function getPreviews(): ArrayCollection
    {
        return $this->images->filter(function(Image $image) {
           return Image::ORIGINAL === $image->getType();
        });
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getFinalPrice(): int
    {
        if ($this->discount > 0) {
            return $this->price - (($this->price / 100) * $this->discount);
        }

        return $this->price;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @return bool
     */
    public function isEnStock(): bool
    {
        return $this->enStock;
    }

    /**
     * @param bool $enStock
     *
     * @return Product
     */
    public function updateEnStock(bool $enStock): self
    {
        $this->enStock = $enStock;

        return $this;
    }

    /**
     * @return Product
     *
     * @throws Exception
     */
    public function setUpdateAt(): self
    {
        $this->seo->setUpdateAt();

        return $this;
    }


        /**
     * @return Collection
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function getSlug(): string
    {
        return $this->seo->getSlug();
    }
}
