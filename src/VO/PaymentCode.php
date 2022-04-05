<?php

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class PaymentCode
{
    public const ROBOKASSA = 'robokassa';

    public const PAYMENT_ON_DELIVERY = 'payment_on_delivery';

    public const VALID_VALUES = [
        self::ROBOKASSA,
        self::PAYMENT_ON_DELIVERY,
    ];

    public const TRANSLATED_VALUES = [
        self::ROBOKASSA => 'робокасса',
        self::PAYMENT_ON_DELIVERY => 'оплата при доставке',
    ];

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
