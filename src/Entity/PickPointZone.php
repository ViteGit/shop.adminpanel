<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PickPointZoneRepository")
 */
class PickPointZone
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $deliveryTerms;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $zone;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $coefficient;

    /**
     * @param string $city
     * @param string $region
     * @param string $deliveryTerms
     * @param int $zone
     * @param float $coefficient
     */
    public function __construct(string $city, string $region, ?string $deliveryTerms, int $zone, ?float $coefficient = null)
    {
        $this->city = $city;
        $this->region = $region;
        $this->zone = $zone;
        $this->coefficient = $coefficient;
        $this->deliveryTerms = $deliveryTerms;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return float | null
     */
    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return int
     */
    public function getZone(): ?int
    {
        return $this->zone;
    }

    /**
     * @return string
     */
    public function getDeliveryTerms(): ?string
    {
        return $this->deliveryTerms;
    }
}
