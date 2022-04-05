<?php

namespace App\VO\DsPlatformaApi;

class OrderItem
{
//    prodID - наш внутренний идентификатор модели;
//aID - это идентификатор товарного предложения. Более подробно - что такое aID?
//qty - количество товара в заказе;
//ds_price - розничная цена этой позиции для конечного покупателя;
//itemcost - оптовая цена этой позиции.

    /**
     * наш внутренний идентификатор модели
     *
     * @var string
     */
    private $prodId;

    /**
     * это идентификатор товарного предложения
     *
     * @var string
     */
    private $aID;

    /**
     * количество товара в заказе
     *
     * @var int
     */
    private $qty;

    /**
     * розничная цена этой позиции для конечного покупателя
     *
     * @var int
     */
    private $dsPrice;

    /**
     * оптовая цена этой позиции
     *
     * @var int
     */
    private $itemcost;

    /**
     * OrderItem constructor.
     * @param string $prodId
     * @param string $aID
     * @param int $qty
     * @param int $dsPrice
     * @param int $itemcost
     */
    public function __construct(string $prodId, string $aID, int $qty, int $dsPrice, int $itemcost)
    {
        $this->prodId = $prodId;
        $this->aID = $aID;
        $this->qty = $qty;
        $this->dsPrice = $dsPrice;
        $this->itemcost = $itemcost;
    }

    /**
     * @return string
     */
    public function getAID(): string
    {
        return $this->aID;
    }

    /**
     * @return int
     */
    public function getDsPrice(): int
    {
        return $this->dsPrice;
    }

    /**
     * @return int
     */
    public function getItemcost(): int
    {
        return $this->itemcost;
    }

    /**
     * @return string
     */
    public function getProdId(): string
    {
        return $this->prodId;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }
}
