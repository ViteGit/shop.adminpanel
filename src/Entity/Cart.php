<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeImmutable;
use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "cart" = "App\Entity\Cart",
 *     "order" = "App\Entity\Order",
 * })
 */
class Cart
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
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $uniqueId;

    /**
     * @var Collection | CartItem[]
     *
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"persist", "remove"})
     */
    private $items;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Collection  | Coupon[]
     *
     * @ORM\OneToMany(targetEntity="Coupon", mappedBy="cart", cascade={"persist"})
     */
    private $coupons;

    /**
     * @param string $uniqueId
     * @param array $items
     * @param User|null $user
     *
     * @param array $coupons
     * @throws Exception
     */
    public function __construct(string $uniqueId, array $items = [], ?User $user = null, array $coupons = [])
    {
        $this->uniqueId = $uniqueId;
        $this->user = $user;
        $this->createdAt = new DateTimeImmutable();
        $this->items = new ArrayCollection(array_unique($items, SORT_REGULAR));
        $this->coupons = new ArrayCollection(array_unique($coupons, SORT_REGULAR));
    }

    /**
     * @param Coupon $coupon
     *
     * @return Cart
     */
    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->coupons->contains($coupon)) {
            $this->coupons->add($coupon);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return User | null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Cart
     */
    public function updateUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection | Product[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }


    public function hasItem(CartItem $item): bool
    {
        return $this->items->contains($item);
    }

    /**
     * @param CartItem $item
     * @return Cart
     */
    public function addItem(CartItem $item): Cart
    {
        if ($this->hasItem($item)) {
            return $this;
        }

        $this->items->add($item);

        return $this;
    }

    /**
     * @return Cart
     */
    public function clearItems(): self
    {
        $this->items->clear();

        return $this;
    }

    /**
     * @return int
     */
    public function countItems(): int
    {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->getQuantity();
        }

        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(CartItem $item): self
    {
        if ($this->hasItem($item)) {
            $this->items->removeElement($item);
        }

        return $this;
    }

    /**
     * @return Collection  | Coupon[]
     */
    public function getCoupons(): Collection
    {
        return $this->coupons;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        $price = 0;

        /**
         * @var CartItem $item
         */
        foreach ($this->items as $item) {
            $price += $item->getQuantity() * $item->getProductVariant()->getProduct()->getPrice();
        }

        return $price;
    }

    /**
     * @return int
     */
    public function getFinalPrice(): int
    {
        $price = 0;

        /**
         * @var CartItem $item
         */
        foreach ($this->items as $item) {
            $price += $item->getQuantity() * $item->getProductVariant()->getProduct()->getFinalPrice();
        }
        /**
         * @var Coupon $coupon
         */
        foreach ($this->coupons as $coupon) {
            $price -= $coupon->getDiscount();
        }

        $user = $this->getUser();

        if (!empty($user)) {
            $price -= $user->getPoints();
        }

        return $price;
    }
}
