<?php

namespace App\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use DateTimeImmutable;

/**
 * @ORM\Embeddable
 */
class StockData
{
    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $shipingTime;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantityInStock;


    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $currencyRetail;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $currencyWhole;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $retailPrice;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $wholePrice;

    /**
     *
     * @var float | null
     *
     * @ORM\Column(type="float")
     */
    private $baseRetailPrice;

    /**
     * @var float | null
     *
     * @ORM\Column(type="float")
     */
    private $baseWholePrice;

    /**
     * @var float | null
     *
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @param int $quantityInStock
     * @param DateTimeImmutable $shipingTime
     * @param float $retailPrice
     * @param float $wholePrice
     * @param float $baseWholePrice
     * @param float $baseRetailPrice
     * @param int $discount
     * @param string $currencyRetail
     * @param string $currencyWhole
     */
    public function __construct(
        int $quantityInStock,
        DateTimeImmutable $shipingTime,
        float $retailPrice,
        float $wholePrice,
        float $baseWholePrice,
        float $baseRetailPrice,
        int $discount,
        string $currencyRetail = 'RU',
        string $currencyWhole = 'RU'
    ) {
        $this->quantityInStock = $quantityInStock;
        $this->shipingTime = $shipingTime;
        $this->retailPrice = $retailPrice;
        $this->wholePrice = $wholePrice;
        $this->baseRetailPrice = $baseRetailPrice;
        $this->baseWholePrice = $baseWholePrice;
        $this->discount = $discount;
        $this->currencyRetail = $currencyRetail;
        $this->currencyWhole = $currencyWhole;
    }

    /**
     * @return float
     */
    public function getWholePrice(): float
    {
        return $this->wholePrice;
    }

    /**
     * @return float
     */
    public function getRetailPrice(): float
    {
        return $this->retailPrice;
    }


    /**
     * @return int
     */
    public function getQuantityInStock(): int
    {
        return $this->quantityInStock;
    }

    /**
     * @return float|null
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * @return float|null
     */
    public function getBaseWholePrice(): ?float
    {
        return $this->baseWholePrice;
    }

    /**
     * @return float|null
     */
    public function getBaseRetailPrice(): ?float
    {
        return $this->baseRetailPrice;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getShipingTime(): DateTimeImmutable
    {
        return $this->shipingTime;
    }

    /**
     * @return string
     */
    public function getCurrencyRetail(): string
    {
        return $this->currencyRetail;
    }

    /**
     * @return string
     */
    public function getCurrencyWhole(): string
    {
        return $this->currencyWhole;
    }
}
