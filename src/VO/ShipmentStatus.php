<?php

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class ShipmentStatus
{
    public const CART = 'cart';

    public const PENDING = 'pending';

    public const READY = 'ready';

    public const SHIPPED = 'shipped';

    public const CANCELLED = 'cancelled';

    public const RECEIVED = 'received';

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
