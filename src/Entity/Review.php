<?php

namespace App\Entity;

use App\VO\MessageStatus;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $rating;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10000)
     */
    protected $comment;

    /**
     * @var bool
     *
     * @ORM\Column(name="status_review", type="boolean")
     */
    protected $status;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var Reviewer
     *
     * @ORM\ManyToOne(targetEntity="Reviewer", inversedBy="reviews", cascade={"persist"})
     * @ORM\JoinColumn(name="reviewer_id", referencedColumnName="id")
     */
    protected $reviewer;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="reviews", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;


    /**
     * @param int $rating
     * @param string $comment
     * @throws Exception
     */
    public function __construct(int $rating, string $comment)
    {
        $this->rating = $rating;
        $this->status = new MessageStatus(MessageStatus::NEW);
        $this->comment = $comment;
        $this->createdAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * {@inheritdoc}
     */
    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getReviewer(): Reviewer
    {
        return $this->reviewer;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param Reviewer
     *
     * @return Review
     */
    public function updateReviewer(Reviewer $reviewer): self
    {
        $this->reviewer = $reviewer;

        return $this;
    }

    /**
     * @param Product
     *
     * @return Review
     */
    public function updateProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
