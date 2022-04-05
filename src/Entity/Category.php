<?php

namespace App\Entity;

use App\DTO\SeoData;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Array_;

/**
 * @ORM\Entity()
 */
class Category
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
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;


    /**
     * @var Seo
     *
     * @ORM\OneToOne(targetEntity="Seo", cascade={"persist"})
     */
    private $seo;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $root;

    /**
     * @var ArrayCollection | Filter[]
     *
     * @ORM\ManyToMany(targetEntity="Filter")
     * @ORM\JoinTable(name="categories_filter",
     *      joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="filter_id", referencedColumnName="id")}
     *      )
     */
    private $filters;

    /**
     * @param string $title
     * @param int $position
     * @param string $description
     * @param array $products
     * @param Seo|null $seo
     */
    public function __construct(string $title, Seo $seo, ?int $position = null, ?string $description = null, array $products = [])
    {
        $this->children = new ArrayCollection();
        $this->position = $position;
        $this->title = $title;
        $this->description = $description;
        $this->seo = $seo;
        $this->products = new ArrayCollection(array_unique($products, SORT_REGULAR));
        $this->root = false;
        $this->label = null;
        $this->filters = new ArrayCollection([]);
    }

    /**
     * @param ArrayCollection | Filter[]
     *
     * @return Category
     */
    public function setFilters($filters): self
    {
        $this->filters = new ArrayCollection(array_unique($filters, SORT_REGULAR));

        return $this;
    }

    /**
     * @return ArrayCollection | Filter[]
     */
    public function getFilters(): ArrayCollection
    {
        return $this->filters;
    }

    /**
     * @return Seo
     */
    public function getSeo(): Seo
    {
        return $this->seo;
    }

    /**
     * @return Category
     */
    public function getParent(): ?Category {
        return $this->parent;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection {
        return $this->children;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Category $child
     *
     * @return Category
     */
    public function addChild(Category $child): self
    {
        $this->children[] = $child;
        $child->setParent($this);

        return $this;
    }

    /**
     * @param Category $parent
     *
     * @return Category
     */
    public function setParent(?Category $parent): self {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param bool $root
     */
    public function setRoot(bool $root): void
    {
        $this->root = $root;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }

    /**
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->root;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->seo->getSlug();
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string | null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }
}
