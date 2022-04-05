<?php

namespace App\VO\DsPlatformaApi;

class OrderPaid
{
    /**
     * 1 - «заказ оплачен Мерчанту»;
     */
    public const PAYED = 1;

    /**
     * 0 - «оплата заказа при получении».
     */
    public const PAYMENT_ON_DELIVERY = 0;

    /**
     * идентификатор заказа в нашей системе
     *
     * @var string
     */
    private $value;

    public const VALID_VALUES = [
        self::PAYED,
        self::PAYMENT_ON_DELIVERY,
    ];

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}