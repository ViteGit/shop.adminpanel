<?php

namespace App\DTO;

use App\Entity\PaymentMethod;
use App\Entity\ShipmentMethod;
use App\VO\Email;
use App\VO\PhoneNumber;

class CheckoutData
{
    /**
     * @var string
     */
    private $fio;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var PhoneNumber
     */
    private $phone;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $postCode;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var ShipmentMethod
     */
    private $shipmentMethod;

    /**
     * @var string | null
     */
    private $notes;

    /**
     * @var string | null
     */
    private $pickUpId;

    /**
     * @param string $fio
     * @param Email $email
     * @param PhoneNumber $phone
     * @param string $city
     * @param string $address
     * @param string $postCode
     * @param PaymentMethod $paymentMethod
     * @param ShipmentMethod $shipmentMethod
     * @param string | null $notes
     * @param string | null $pickUpId
     */
    public function __construct(
        string $fio,
        Email $email,
        PhoneNumber $phone,
        string $city,
        string $address,
        string $postCode,
        PaymentMethod $paymentMethod,
        ShipmentMethod $shipmentMethod,
        ?string $notes,
        ?string $pickUpId
    ) {
        $this->fio = $fio;
        $this->email = $email;
        $this->phone = $phone;
        $this->city = $city;
        $this->address = $address;
        $this->postCode = $postCode;
        $this->paymentMethod = $paymentMethod;
        $this->shipmentMethod = $shipmentMethod;
        $this->notes = $notes;
        $this->pickUpId = $pickUpId;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string | null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return ShipmentMethod
     */
    public function getShipmentMethod(): ShipmentMethod
    {
        return $this->shipmentMethod;
    }

    /**
     * @return string | null
     */
    public function getPickUpId(): ?string
    {
        return $this->pickUpId;
    }
}