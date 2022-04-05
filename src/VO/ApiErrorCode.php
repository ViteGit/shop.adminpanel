<?php

namespace App\VO;

use InvalidArgumentException;

class ApiErrorCode
{
    /**
     * Не передан токен
     */
    public const AUTHENTICATION_TOKEN_ABSENCE = 'authentication-token-absence';


    /**
     * Допустимые значения кода ошибки
     */
    private const VALID_VALUES = [
    ];

    /**
     * @var string
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
            throw new InvalidArgumentException("Недопустимое значение кода ошибки $value");
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
    public function __toString(): string
    {
        return $this->getValue();
    }
}
