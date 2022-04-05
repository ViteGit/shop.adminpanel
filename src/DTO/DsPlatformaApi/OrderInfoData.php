<?php

namespace App\DTO\DsPlatformaApi;

use App\VO\DsPlatformaApi\Delivery;
use App\VO\DsPlatformaApi\MoneyHistory;
use App\VO\DsPlatformaApi\OrderItem;
use App\VO\DsPlatformaApi\OrderPaid;
use App\VO\DsPlatformaApi\PostData;
use App\VO\DsPlatformaApi\Status;
use App\VO\DsPlatformaApi\StatusHistory;
use App\VO\Email;
use App\VO\PhoneNumber;

class OrderInfoData
{
    /**
     * идентификатор заказа в нашей системе
     *
     * @var string
     */
    private $orderID;

    /**
     * идентификатор заказа в Вашем интернет-магазине
     *
     * @var string
     */
    private $extOrderID;

    /**
     * дата размещения заказа в вашем интернет-магазине
     *
     * @var \DateTimeImmutable
     */
    private $extDateOfAdded;

    /**
     * статус оплаты заказа. Может иметь два значения
     *
     * @var OrderPaid
     */
    private $extOrderPaid;

    /**
     * число. Стоимость товаров в заказе для конечного получателя
     *
     * @var int
     */
    private $extOrderTotal;

    /**
     *  число. Стоимость доставки для конечного получателя
     *
     * @var int
     */
    private $extDeliveryCost;

    /**
     * число. Себестоимость доставки до покупателя. В процессе выполнения эта поле пустое,
     * т.к. точную стоимость доставки мы узнаем после завершения выполнения заказа и
     * получения отчётных документов от службы доставки
     *
     * @var int | null
     */
    private $dsDeliveryPriceTo;

    /**
     * число. Себестоимость возврата заказа от покупателя. В процессе выполнения эта поле пустое,
     * т.к. точную стоимость возврата заказа мы узнаем после завершения осуществления возврата заказа и
     * получения отчётных документов от службы доставки.
     *
     * @var int | null
     */
    private $dsDeliveryPriceBack;

    /**
     * число. Сумма агентского вознаграждения, в случае если мы принимаем в оплату в Ваш адрес по этому заказу.
     *
     * @var int
     */
    private $dsDeliveryAgentMoney;

    /**
     * @var Delivery
     */
    private $dsDelivery;

    /**
     * ФИО покупателя
     *
     * @var string
     */
    private $dsFio;

    /**
     * почтовый индекс
     *
     * @var string
     */
    private $dsPostcode;

    /**
     * страна
     *
     * @var string
     */
    private $dsCountry;

    /**
     * область
     *
     * @var string
     */
    private $dsArea;

    /**
     * Город
     *
     * @var string
     */
    private $dsCity;

    /**
     * Улица
     *
     * @var string
     */
    private $dsStreet;

    /**
     * Дом
     *
     * @var string
     */
    private $dsHouse;

    /**
     * Квартира
     *
     * @var string
     */
    private $dsFlat;

    /**
     * email
     *
     * @var Email
     */
    private $dsEmail;

    /**
     * телефон
     *
     * @var PhoneNumber
     *
     */
    private $dsMobPhone;

    /**
     *  пожелания покупателя по дате/времени доставки заказа
     *
     * @var \DateTimeImmutable
     */
    private $dsDeliveryDate;

    /**
     * Метро
     *
     * @var string | null
     */
    private $dsMetro;

    /**
     * комментарии покупателя к заказу
     *
     * @var string
     */
    private $dsComments;

    /**
     * идентификатор постомата или ПВЗ PickPoint
     *
     * @var string
     */
    private $dsPickPointID;

    /**
     * полный адрес постомата или ПВЗ PickPoint.
     *
     * @var string
     */
    private $dsFullAddress;

    /**
     *  дата и время размещения заказа у нас в системе.
     *
     * @var \DateTimeImmutable
     */
    private $orderDate;

    /**
     * плановая дата отгрузки заказа с нашего склада.
     *
     * @var \DateTimeImmutable
     */
    private $pickupDate;

    /**
     * текущий статус заказа. Целое число. Варианты значений:
     *
     * @var Status
     */
    private $status;

    /**
     * число. Оптовая стоимость товаров в заказе
     *
     * @var int
     */
    private $orderTotal;

    /**
     * блок с информацией о составе заказа.
     *
     * @var array OrderItem[]
     */
    private $orderItems;

    /**
     * блок с информацией о трекинге отправления в службе доставки.
     * Блок выводится только для внешних служб доставки (Почта РФ, PickPoint, DPD и т.п.).
     * Блок выводится только в случае если отправление уже в пути. Блок содержит следующие данные:
     *
     * @var PostData
     */
    private $postData;

    /**
     * блок с хронологией изменения статуса заказа. Тут приведена информация о том - когда, в каком статусе находился заказ
     *
     * @var StatusHistory
     */
    private $statusHistory;

    /**
     * блок с финансовыми операциями по этому заказу. Тут приведена полная информация о всех списаниях и начислениях по заказау
     *
     * @var MoneyHistory
     */
    private $moneyHistory;

    /**
     * @param string $orderID
     * @param string $extOrderID
     * @param \DateTimeImmutable $extDateOfAdded
     * @param OrderPaid $extOrderPaid
     * @param int $extOrderTotal
     * @param int $extDeliveryCost
     * @param int $dsDeliveryPriceTo
     * @param int $dsDeliveryPriceBack
     * @param int $dsDeliveryAgentMoney
     * @param Delivery $dsDelivery
     * @param string $dsFio
     * @param string $dsPostcode
     * @param string $dsCountry
     * @param string $dsArea
     * @param string $dsCity
     * @param string $dsStreet
     * @param string $dsHouse
     * @param string $dsFlat
     * @param Email $dsEmail
     * @param PhoneNumber $dsMobPhone
     * @param \DateTimeImmutable $dsDeliveryDate
     * @param string|null $dsMetro
     * @param string|null $dsComments
     * @param $dsPickPointID
     * @param string $dsFullAddress
     * @param \DateTimeImmutable $orderDate
     * @param \DateTimeImmutable $pickupDate
     * @param Status $status
     * @param int $orderTotal
     * @param OrderItem $orderItems
     * @param PostData $postData
     * @param StatusHistory $statusHistory
     * @param MoneyHistory $moneyHistory
     */
    public function __construct(
        string $orderID,
        string $extOrderID,
        \DateTimeImmutable $extDateOfAdded,
        OrderPaid $extOrderPaid,
        int $extOrderTotal,
        int $extDeliveryCost,
        int $dsDeliveryPriceTo,
        int $dsDeliveryPriceBack,
        int $dsDeliveryAgentMoney,
        Delivery $dsDelivery,
        string $dsFio,
        string $dsPostcode,
        string $dsCountry,
        string $dsArea,
        string $dsCity,
        string $dsStreet,
        string $dsHouse,
        string $dsFlat,
        Email $dsEmail,
        PhoneNumber $dsMobPhone,
        \DateTimeImmutable $dsDeliveryDate,
        ?string $dsMetro,
        ?string $dsComments,
        $dsPickPointID,
        string $dsFullAddress,
        \DateTimeImmutable $orderDate,
        \DateTimeImmutable $pickupDate,
        Status $status,
        int $orderTotal,
        OrderItem $orderItems,
        PostData $postData,
        StatusHistory $statusHistory,
        MoneyHistory $moneyHistory
    ) {
        $this->orderID = $orderID;
        $this->extOrderID = $extOrderID;
        $this->extDateOfAdded = $extDateOfAdded;
        $this->extOrderPaid = $extOrderPaid;
        $this->extOrderTotal = $extOrderTotal;
        $this->extDeliveryCost = $extDeliveryCost;
        $this->dsDeliveryPriceTo = $dsDeliveryPriceTo;
        $this->dsDeliveryPriceBack = $dsDeliveryPriceBack;
        $this->dsDeliveryAgentMoney = $dsDeliveryAgentMoney;
        $this->dsDelivery = $dsDelivery;
        $this->dsFio = $dsFio;
        $this->dsPostcode = $dsPostcode;
        $this->dsCountry = $dsCountry;
        $this->dsArea = $dsArea;
        $this->dsCity = $dsCity;
        $this->dsStreet = $dsStreet;
        $this->dsHouse = $dsHouse;
        $this->dsFlat = $dsFlat;
        $this->dsEmail = $dsEmail;
        $this->dsMobPhone = $dsMobPhone;
        $this->dsDeliveryDate = $dsDeliveryDate;
        $this->dsMetro = $dsMetro;
        $this->dsComments = $dsComments;
        $this->dsPickPointID = $dsPickPointID;
        $this->dsFullAddress = $dsFullAddress;
        $this->orderDate = $orderDate;
        $this->pickupDate = $pickupDate;
        $this->status = $status;
        $this->orderTotal = $orderTotal;
        $this->orderItems = $orderItems;
        $this->postData = $postData;
        $this->statusHistory = $statusHistory;
        $this->moneyHistory = $moneyHistory;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOrderDate(): \DateTimeImmutable
    {
        return $this->orderDate;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDsArea(): string
    {
        return $this->dsArea;
    }

    /**
     * @return string
     */
    public function getDsCity(): string
    {
        return $this->dsCity;
    }

    /**
     * @return string
     */
    public function getDsComments(): string
    {
        return $this->dsComments;
    }

    /**
     * @return string
     */
    public function getDsCountry(): string
    {
        return $this->dsCountry;
    }

    /**
     * @return Delivery
     */
    public function getDsDelivery(): Delivery
    {
        return $this->dsDelivery;
    }

    /**
     * @return int
     */
    public function getDsDeliveryAgentMoney(): int
    {
        return $this->dsDeliveryAgentMoney;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDsDeliveryDate(): \DateTimeImmutable
    {
        return $this->dsDeliveryDate;
    }

    /**
     * @return int|null
     */
    public function getDsDeliveryPriceBack(): ?int
    {
        return $this->dsDeliveryPriceBack;
    }

    /**
     * @return int|null
     */
    public function getDsDeliveryPriceTo(): ?int
    {
        return $this->dsDeliveryPriceTo;
    }

    /**
     * @return Email
     */
    public function getDsEmail(): Email
    {
        return $this->dsEmail;
    }

    /**
     * @return string
     */
    public function getDsFio(): string
    {
        return $this->dsFio;
    }

    /**
     * @return string
     */
    public function getDsFlat(): string
    {
        return $this->dsFlat;
    }

    /**
     * @return string
     */
    public function getDsFullAddress(): string
    {
        return $this->dsFullAddress;
    }

    /**
     * @return string
     */
    public function getDsHouse(): string
    {
        return $this->dsHouse;
    }

    /**
     * @return string|null
     */
    public function getDsMetro(): ?string
    {
        return $this->dsMetro;
    }

    /**
     * @return PhoneNumber
     */
    public function getDsMobPhone(): PhoneNumber
    {
        return $this->dsMobPhone;
    }

    /**
     * @return string
     */
    public function getDsPickPointID(): string
    {
        return $this->dsPickPointID;
    }

    /**
     * @return string
     */
    public function getDsPostcode(): string
    {
        return $this->dsPostcode;
    }

    /**
     * @return string
     */
    public function getDsStreet(): string
    {
        return $this->dsStreet;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExtDateOfAdded(): \DateTimeImmutable
    {
        return $this->extDateOfAdded;
    }

    /**
     * @return int
     */
    public function getExtDeliveryCost(): int
    {
        return $this->extDeliveryCost;
    }

    /**
     * @return string
     */
    public function getExtOrderID(): string
    {
        return $this->extOrderID;
    }

    /**
     * @return OrderPaid
     */
    public function getExtOrderPaid(): OrderPaid
    {
        return $this->extOrderPaid;
    }

    /**
     * @return int
     */
    public function getExtOrderTotal(): int
    {
        return $this->extOrderTotal;
    }

    /**
     * @return MoneyHistory
     */
    public function getMoneyHistory(): MoneyHistory
    {
        return $this->moneyHistory;
    }

    /**
     * @return string
     */
    public function getOrderID(): string
    {
        return $this->orderID;
    }

    /**
     * @return array
     */
    public function getOrderItems(): array
    {
        return $this->orderItems;
    }

    /**
     * @return int
     */
    public function getOrderTotal(): int
    {
        return $this->orderTotal;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPickupDate(): \DateTimeImmutable
    {
        return $this->pickupDate;
    }

    /**
     * @return PostData
     */
    public function getPostData(): PostData
    {
        return $this->postData;
    }

    /**
     * @return StatusHistory
     */
    public function getStatusHistory(): StatusHistory
    {
        return $this->statusHistory;
    }
}
