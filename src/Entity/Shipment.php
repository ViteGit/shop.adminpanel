<?php

namespace App\Entity;

use App\DTO\ShippingData;
use App\VO\ShipmentStatus;
use DateTimeImmutable;
use Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Shipment
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
     * @var ShipmentStatus
     *
     * @ORM\Embedded(class="App\VO\ShipmentStatus", columnPrefix=false)
     */
    private $status;

    /**
     * @var Order
     *
     * @ORM\OneToOne(targetEntity="Order", mappedBy="shipment", cascade={"persist"})
     */
    private $order;

    /**
     * @var ShipmentMethod
     *
     * @ORM\ManyToOne(targetEntity="ShipmentMethod")
     * @@ORM\JoinColumn(name="shipment_method_id", referencedColumnName="id")
     */
    private $shipmentMethod;


    /**
     * @var ShippingData
     *
     * @ORM\Embedded(class="App\DTO\ShippingData", columnPrefix=false)
     */
    private $shippingData;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $tracking;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @param ShipmentStatus $status
     * @param ShipmentMethod $shipmentMethod
     * @param ShippingData $shippingData
     * @param string | null $tracking
     *
     * @throws Exception
     */
    public function __construct(
        ShipmentStatus $status,
        ShipmentMethod $shipmentMethod,
        ShippingData $shippingData,
        ?string $tracking
    ) {
        $this->status = $status;
        $this->shipmentMethod = $shipmentMethod;
        $this->shippingData = $shippingData;
        $this->tracking = $tracking;
        $this->createdAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = new ShipmentStatus($status);
    }

    /**
     * @return ShipmentStatus
     */
    public function getStatus(): ShipmentStatus
    {
        return $this->status;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return ShippingData
     */
    public function getShippingData(): ShippingData
    {
        return $this->shippingData;
    }

    /**
     * @return string|null
     */
    public function getTracking(): ?string
    {
        return $this->tracking;
    }

    /**
     * @return ShipmentMethod
     */
    public function getShipmentMethod(): ShipmentMethod
    {
        return $this->shipmentMethod;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
