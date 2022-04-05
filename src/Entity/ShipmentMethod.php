<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipmentMethodRepository")
 */
class ShipmentMethod extends Method
{
    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $price;

    /**
     * @param string $label
     * @param string $code
     * @param string $description
     * @param bool $active
     * @param int $price
     *
     * @throws Exception
     */
    public function __construct(string $label, string $code, string $description, bool $active, int $price)
    {
        $this->price = $price;

      parent::__construct($label, $code, $description, $active);
    }

    /**
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
