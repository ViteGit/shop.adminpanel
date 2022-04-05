<?php

namespace App\Entity;

use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartItemRepository")
 */
class CartItem
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
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="items", cascade={"persist"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $cart;

    /**
     * @var ProductVariant
     *
     * @ORM\ManyToOne(targetEntity="ProductVariant")
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id")
     */
    private $productVariant;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;


    /**
     * @param Cart $cart
     * @param ProductVariant $productVariant
     * @param int $quantity
     * @throws Exception
     */
    public function __construct(Cart $cart, ProductVariant $productVariant, int $quantity)
    {
        $this->cart = $cart;
        $this->productVariant = $productVariant;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @return CartItem
     */
    public function dropCart(): self
    {
        $this->cart = null;

        return $this;
    }

    /**
     * @return ProductVariant
     */
    public function getProductVariant(): ProductVariant
    {
        return $this->productVariant;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getItemPrice(): int
    {
        return $this->getProductVariant()->getProduct()->getPrice();
    }

    /**
     * @return int
     */
    public function getTotalItemPrice(): int
    {
        return $this->quantity * $this->getItemPrice();
    }

    /**
     * @param int $quantity
     *
     * @return CartItem
     */
    public function updateQuantity(int $quantity): self
    {
        $this->quantity += $quantity;

        return $this;
    }

    /**
     * @param Cart $cart
     *
     * @return CartItem
     */
    public function updateCart(Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
