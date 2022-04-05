<?php

namespace App\VO\DsPlatformaApi;

class Status
{
    /**
     * 1 - Принят
     */
    private const RECEVIED = 1;

    /**
     * 2 - Обработка на складе
     */
    private const STOCK_RPOCESSING = 2;

    /**
     * 3 - Ожидает подтверждения
     */
    private const WAITING_CONFIRMATION = 3;

    /**
     * 4 - Товар забронирован
     */
    private const PRODUCT_BOOKED = 4;

    /**
     * 5 - Готов к отгрузке
     */
    private const READY_FOR_SHIPMENT = 5;

    /**
     * 6 - Выслан на почту
     */
    private const SENT_BY_MAIL = 6;

    /**
     * 7 - Оплачен и доставлен
     */
    private const PAID_AND_DELIVERED = 7;

    /**
     * 8 - Отказ
     */
    private const REJECTION = 8;

    /**
     * 9 - Комплектация товара на складе
     */
    private const PICKING_GOOODS_IN_STOCK = 9;

    /**
     * 10 - Злонамеренный отказ
     */
    private const MALICIOUS_REJECTION = 10;

    /**
     * 11 - Отправлен с курьером
     */
    private const SENT_BY_COURRIER = 11;

    /**
     * 12 - Отгружен. Ожидаем оплату
     */
    private const DELIVERED_AWAITING_PAYMENT = 12;

    /**
     * 13 - Удален
     */
    private const DELETED = 13;

    /**
     * @var string
     */
    private $value;

    public const VALID_VALUES = [
        self::RECEVIED,
        self::STOCK_RPOCESSING,
        self::WAITING_CONFIRMATION,
        self::PRODUCT_BOOKED,
        self::READY_FOR_SHIPMENT,
        self::SENT_BY_MAIL,
        self::PAID_AND_DELIVERED,
        self::REJECTION,
        self::PICKING_GOOODS_IN_STOCK,
        self::MALICIOUS_REJECTION,
        self::SENT_BY_COURRIER,
        self::DELIVERED_AWAITING_PAYMENT,
        self::DELETED,
    ];

    /**
     * @param string $value
     */
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
