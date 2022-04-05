<?php

namespace App\Entity;

use App\DTO\ShippingData;
use DateTimeImmutable;
use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order extends Cart
{
    /** @var int
     *
     * @ORM\Column(type="integer", nullable=true, unique=true)
     */
    private $orderId;

    /** @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $notes;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $orderDate;

    /**
     * @var Shipment
     *
     * @ORM\OneToOne(targetEntity="Shipment", inversedBy="order", cascade={"persist"})
     */
    private $shipment;

    /**
     * @var Payment
     *
     * @ORM\OneToOne(targetEntity="Payment", inversedBy="order", cascade={"persist"})
     */
    private $payment;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $orderPrice;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $shipmentPrice;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @param int $orderPrice
     * @param int $shipmentPrice
     * @param int $orderId
     * @param int $points
     * @param string $uniqueId
     * @param array $items
     * @param string | null $notes
     * @param User|null $user
     * @param array $coupons
     * @param Payment $payment
     * @param Shipment|null $shipment
     *
     * @throws Exception
     */
    public function __construct(
        int $orderPrice,
        int $shipmentPrice,
        int $orderId,
        int $points,
        string $uniqueId,
        array $items = [],
        ?string $notes = null,
        ?User $user = null,
        array $coupons = [],
        ?Payment $payment = null,
        ?Shipment $shipment = null
    ) {
        $this->shipmentPrice = $shipmentPrice;
        $this->orderId = $orderId;
        $this->points = $points;
        $this->notes = $notes;
        $this->orderDate = new DateTimeImmutable();
        $this->orderPrice = $orderPrice;
        $this->payment = $payment;
        $this->shipment = $shipment;

        parent::__construct($uniqueId, $items, $user, $coupons);
    }

    /**
     * @return Payment
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @return Shipment
     */
    public function getShipment(): ?Shipment
    {
        return $this->shipment;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getOrderDate(): DateTimeImmutable
    {
        return $this->orderDate;
    }

    /**
     * @return string | null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @return ShipmentMethod
     */
    public function getShipmentMethod(): ShipmentMethod
    {
        return $this->shipment->getShipmentMethod();
    }

    /**
     * @return int
     */
    public function getShipmentPrice(): int
    {
        return $this->shipmentPrice;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->payment->getPaymentMethod();
    }

    /**
     * @return int
     */
    public function getOrderPrice(): int
    {
        return $this->orderPrice;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return ShippingData
     */
    public function getShippingData(): ShippingData
    {
        return $this->shipment->getShippingData();
    }
}
