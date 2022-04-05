<?php

namespace App\VO\DsPlatformaApi;

class Delivery
{
    /**
     * 1 - Наш курьер по Москве
     */
    public const COURIER_IN_MOSCOW = 1;

    /**
     *  2 - Почта РФ
     */
    public const RUSSIAN_POST = 2;

    /**
     * 4 - Самовывоз Москва, м. Автозаводская
     */
    public const PICKUP_MOSCOW = 4;

    /**
     * 5 - PickPoint
     */
    public const PICK_POINT = 5;

    /**
     * 8 - Курьер по России (DPD до двери)
     */
    public const DPD = 8;

    /**
     * 10 - Курьер по России (СДЭК до двери)
     */
    public const SDEK = 10;

    /**
     * идентификатор заказа в нашей системе
     *
     * @var string
     */
    private $value;

    public const VALID_VALUES = [
        self::COURIER_IN_MOSCOW,
        self::RUSSIAN_POST,
        self::PICKUP_MOSCOW,
        self::PICK_POINT,
        self::DPD,
        self::SDEK,
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
