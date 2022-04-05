<?php

namespace App\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;

/**
 * @ORM\Embeddable
 */
class ProductCharacteristicsData
{
    /**
     * @var int
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $brutto;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $batteries;

    /**
     * Упаковка
     *
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $pack;

    /**
     * Материал
     *
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $material;

    /**
     * @var int | null
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $lenght;

    /**
     * @var int | null
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $diameter;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $collectionName;


    /**
     * @param $brutto
     * @param $batteries
     * @param $pack
     * @param $material
     * @param $lenght
     * @param $diameter
     * @param $collectionName
     * @param $color
     * @param $size
     */
    public function __construct(
        ?int $brutto,
        ?string $batteries,
        ?string $pack,
        ?string $material,
        ?float $lenght,
        ?float $diameter,
        ?string $collectionName
    ) {
        $this->brutto = $brutto;
        $this->batteries = $batteries;
        $this->pack = $pack;
        $this->material = $material;
        $this->lenght = $lenght;
        $this->diameter = $diameter;
        $this->collectionName = $collectionName;
    }

    /**
     * @return string|null
     */
    public function getBatteries(): ?string
    {
        return $this->batteries;
    }

    /**
     * @return int
     */
    public function getBrutto(): ?int
    {
        return $this->brutto;
    }

    /**
     * @return string|null
     */
    public function getCollectionName(): ?string
    {
        return $this->collectionName;
    }

    /**
     * @return int|null
     */
    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    /**
     * @return int|null
     */
    public function getLenght(): ?int
    {
        return $this->lenght;
    }

    /**
     * @return string|null
     */
    public function getMaterial(): ?string
    {
        return $this->material;
    }

    /**
     * @return string|null
     */
    public function getPack(): ?string
    {
        return $this->pack;
    }

}
