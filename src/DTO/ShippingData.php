<?php

namespace App\DTO;

use App\VO\Email;
use App\VO\PhoneNumber;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class ShippingData
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fio;

    /**
     * @var string
     *
     * @ORM\Column(type="phone_number")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="email")
     */
    private $email;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $city;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $address;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $postcode;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $pickUpId;

    /**
     * @param string $fio
     * @param PhoneNumber $phoneNumber
     * @param Email $email
     * @param string | null $city
     * @param string | null $address
     * @param string | null $pickUpId
     * @param string|null $postcode
     */
    public function __construct(
        string $fio,
        PhoneNumber $phoneNumber,
        Email $email,
        ?string $city = null,
        ?string $address = null,
        ?string $pickUpId = null,
        ?string $postcode = null
    ) {
        $this->fio = $fio;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->city = $city;
        $this->address = $address;
        $this->pickUpId = $pickUpId;
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return string | null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string | null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string | null
     */
    public function getPickUpId(): ?string
    {
        return $this->pickUpId;
    }

    /**
     * @return string | null
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }
}
