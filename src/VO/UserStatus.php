<?php

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;

/**
 * @Embeddable
 */
class UserStatus
{

    public const NOT_ACTIVE = 'not-active';

    public const ACTIVE = 'active';

    public const BLOCKED = 'blocked';

    /**
     * Допустимые значения статусов
     */
    public const VALID_VALUES = [
        self::NOT_ACTIVE,
        self::ACTIVE,
        self::BLOCKED,
    ];

    /**
     * Перевод статусов на человеческий язык
     */
    public const VIEW_STATUSES = [
        self::NOT_ACTIVE => 'Не активен',
        self::ACTIVE => 'Активен',
        self::BLOCKED => 'Заблокирован',
    ];

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="status", options={"default": "active"})
     */
    private $value;

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if (!in_array($value, self::VALID_VALUES)) {
            throw new InvalidArgumentException("Недопустимый статус пользователя $value");
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
     * Возвращает перевод статуса на человеческий язык
     *
     * @return string
     */
    public function getName(): string
    {
        return self::VIEW_STATUSES[$this->value];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
