<?php

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class OrderStatus
{
    public const NEW = 'new';
    public const NOT_PAYED = 'not-payed';
    public const PAYED = 'payed';
    public const READY_FOR_SHIPMENT = 'ready-for-shipment';
    public const SEND = 'send';
    public const RECEIVED = 'received';
    public const CANCELED = 'canceled';

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="status")
     */
    private $value;

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
        return $this->getValue();
    }
}
