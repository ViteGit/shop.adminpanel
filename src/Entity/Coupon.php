<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouponRepository")
 */
class Coupon
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
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $expireAt;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $used;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var Cart
     *
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="coupons", cascade={"persist"})
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

    /**
     * @param int $discount
     * @param string $label
     * @param string $code
     * @param string $description
     * @param DateTimeImmutable $expireAt
     *
     * @throws Exception
     */
    public function __construct(
        int $discount,
        string $label,
        string $code,
        string $description,
        DateTimeImmutable $expireAt
    ) {
        $this->discount = $discount;
        $this->label = $label;
        $this->description = $description;
        $this->expireAt = $expireAt;
        $this->used = false;
        $this->createdAt = new DateTimeImmutable();
        $this->code = $code;
    }

    /**
     * @param Cart $cart
     *
     * @return Coupon
     */
    public function addCart(Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpireAt(): DateTimeImmutable
    {
        return $this->expireAt;
    }

    /**
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->used;
    }

    /**
     * @return Coupon
     */
    public function setUsed(): self
    {
        $this->used = true;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     *
     * @return Coupon
     */
    public function updateCart(Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
