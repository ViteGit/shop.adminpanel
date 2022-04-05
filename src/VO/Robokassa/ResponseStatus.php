<?php

namespace App\VO\Robokassa;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Embeddable
 */
class ResponseStatus
{
    public const STATUS_NOT_FOUND = 1;
    public const STATUS_PENDING = 5;
    public const STATUS_CANCELLED = 10;
    public const STATUS_PROCESSING = 50;
    public const STATUS_REFUND = 60;
    public const STATUS_PAUSE = 80;
    public const STATUS_COMPLETED = 100;

    private const VALID_VALUES = [
        self::STATUS_NOT_FOUND,
        self::STATUS_PENDING,
        self::STATUS_CANCELLED,
        self::STATUS_PROCESSING,
        self::STATUS_REFUND,
        self::STATUS_PAUSE,
        self::STATUS_COMPLETED,
    ];

    private const STATUSES = [
        self::STATUS_NOT_FOUND  => 'NotFound',
        self::STATUS_PENDING    => 'Pending',
        self::STATUS_CANCELLED  => 'Cancelled',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_REFUND     => 'Refund',
        self::STATUS_PAUSE      => 'Pause',
        self::STATUS_COMPLETED  => 'Completed',
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
        if (!in_array($value, self::VALID_VALUES)) {
            throw new InvalidArgumentException("Неизвестный статус платежа ответа робокассы: $value");
        }

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
    public function getHumanValue(): string
    {
        return self::STATUSES[$this->value];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
