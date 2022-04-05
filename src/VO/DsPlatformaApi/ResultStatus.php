<?php

namespace App\VO\DsPlatformaApi;

class ResultStatus
{
    /**
     * 1 - "Ok", Запрос выполнен успешно
     */
    private const OK = 1;

    /**
     * 2 - "Bad key", Проверьте корректность Вашего ApiKey
     */
    private const BAD_API_KEY = 2;

    /**
     * 3 - "Bad order request", Не корректные данные в поле order.
     */
    private const BAD_ORDER_REQUEST = 3;

    /**
     * 4 - "Order do not placed. Some items not at stock OR some problem in aID.",
     * Заказ не размещен, Либо каких-то товаров недостаточное количество на нашем складе,
     * либо какие-то aID не найдены в нашей системе.
     */
    private const ORDER_IS_NOT_PLACED = 4;

    /**
     * 5 - "TestMode. Data was checked. Order have NOT placed.".
     * Включен тестовый режим. Данные проверены, но заказ не размещается.
     */
    private const TEST_MODE = 5;

    /**
     * 6 - Попытка размещения Drop Shipping заказа из под оптового аккаунта не имеющего статус Drop Shipping.
     * Уточните у нашего менеджера - подписан ли Ваш «Договор Прямой Поставки» и зачислен ли депозит на Ваш аккаунт.
     */
    private const NOT_DROP_SHIPER = 6;

    /**
     * 7 - Внутренний номер DS-заказа (ExtOrderID) не уникален.
     */
    private const EXT_ORDER_ID_IS_NOT_UNIQUE = 7;

    /**
     * 8 - Не задан внутренний номер заказа (ExtOrderID)
     */
    private const EXT_ORDER_ID_IS_EMPTY = 8;

    /**
     * 9 - Не корректный формат даты размещения заказа ExtDateOfAdded. Корректный формат - YYYY-MM-DD HH:MM:SS.
     */
    private const EXT_DATE_OF_ADDED_WRONG_FORMAT = 9;

    /**
     * 10 - Не указан статус оплаты заказа (ExtOrderPaid)
     */
    private const EXT_ORDER_PAID_IS_EMPTY = 10;

    /**
     * 11 - Не корректно указана стоимость доставки ExtDeliveryCost. Значение может быть только числом.
     */
    private const EXT_DELIVERY_COST_IS_NOT_NUMBER = 11;

    /**
     * 12 - Стоимость доставки ExtDeliveryCost не указанa.
     */
    private const EXT_DELIVERY_COST_IS_EMPTY = 12;

    /**
     * 13 - Не выбран способ доставки заказа dsDelivery.
     */
    private const DS_DELIVERY_IS_EMPTY = 13;

    /**
     * 14 - ФИО покупателя (dsFio) - обязательны для заполнения!
     */
    private const DS_FIO_IS_EMPTY = 14;

    /**
     * 15 - Телефон покупателя (dsMobPhone) - обязателен для заполнения!
     */
    private const DS_MOB_PHONE_IS_EMPTY = 15;

    /**
     * 16 - Email покупателя (dsEmail) - обязателен для заполнения!
     */
    private const DS_EMAIL_IS_EMPTY = 16;

    /**
     * 17 - Не известный метод доставки. Вероятно вы указали в поле dsDelivery,
     * значение не соответствующее ни одному из обрабатываемых нами.
     */
    private const UKNOWN_DELIVERY_METHOD = 17;

    /**
     * 18 - В случае доставки Почтой России, название населенного пункта (dsCity) обязательно для заполнения!
     */
    private const DS_CITY_IS_EMPTY = 18;

    /**
     * 19 - В случае доставки через PickPoint, индентификатор постомата или ПВЗ (dsPickPointID) обязателен!
     */
    private const DS_PICK_POINT_ID_IS_EMPTY = 19;

    /**
     * 20 - "Request do not have any ExtOrderID or orderID.", в запросе нет ни одного идентификатора заказа
     */
    private const BAD_REQUEST = 20;

    /**
     * 21 - "Some orders was not found.", для некоторых идентификаторов заказов из запроса заказы не найдены.
     * В этом случае в ответе будет приведен блок NotFoundOrders,
     * в котором будут указаны идентификаторы заказы по которым не найдены.
     */
    private const SOME_ORDERS_NOT_FOUND = 21;

    /**
     * @var string
     */
    private $value;

    public const VALID_VALUES = [
        self::OK,
        self::BAD_API_KEY,
        self::BAD_REQUEST,
        self::SOME_ORDERS_NOT_FOUND,
        self::BAD_ORDER_REQUEST,
        self::ORDER_IS_NOT_PLACED,
        self::TEST_MODE,
        self::NOT_DROP_SHIPER,
        self::EXT_ORDER_ID_IS_NOT_UNIQUE,
        self::EXT_ORDER_ID_IS_EMPTY,
        self::EXT_DATE_OF_ADDED_WRONG_FORMAT,
        self::EXT_ORDER_PAID_IS_EMPTY,
        self::EXT_DELIVERY_COST_IS_NOT_NUMBER,
        self::EXT_DELIVERY_COST_IS_EMPTY,
        self::DS_DELIVERY_IS_EMPTY,
        self::DS_FIO_IS_EMPTY,
        self::DS_MOB_PHONE_IS_EMPTY,
        self::DS_EMAIL_IS_EMPTY,
        self::UKNOWN_DELIVERY_METHOD,
        self::DS_CITY_IS_EMPTY,
        self::DS_PICK_POINT_ID_IS_EMPTY,
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