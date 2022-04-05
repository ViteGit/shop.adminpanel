<?php

namespace App\VO\Robokassa;

use InvalidArgumentException;

class ErrorCode
{
    /**
     * Тестовый платёж не может быть создан. У магазина отсутствуют настройки тестовых параметров
     */
    public const TEST_PAYMENT_FAILED = 23;

    /**
     * Магазин не активирован
     */
    public const SHOP_NOT_ACTIVE = 25;

    /**
     * Магазин не найден
     */
    public const SHOP_NOT_FOUND = 26;

    /**
     * Неверный параметр Signature
     */
    public const WRONG_SIGNATURE = 29;

    /**
     * Неверный параметр счёта
     */
    public const WRONG_PARAM = 30;

    /**
     * Неверная сумма платежа
     */
    public const WRONG_SUM = 31;

    /**
     * Время отведённое на оплату счёта истекло
     */
    public const PAYMENT_TIME_EXPIRED = 33;

    /**
     * Услуга рекуррентных платежей не разрешена магазину
     */
    public const RECURRING_PAYMENT_NOT_ALLOWED = 34;

    /**
     * Неверные параметры для инициализации рекуррентного платежа
     */
    public const RECURRING_PAYMENT_WRONG_PARAM = 35;

    /**
     * Повторная оплата счета с тем же номером невозможна
     */
    public const INV_ID_NOT_UNIOQUE = 40;

    /**
     * Ошибка на старте операции
     */
    public const INIT_OPERATION_ERROR = 41;

    /**
     * Тестовый номер счета не может быть использован для проведения оплаты
     */
    public const TEST_ACCOUNT_NUMBER_NOT_ALLOWED_FOR_PAYMENT = 42;

    /**
     * Ошибка конвертации валюты
     */
    public const UNKNOWN_CURRENCY = 60;

    /**
     * Внутренние ошибки сервиса
     */
    public const EXTERNAL_SERVICE_ERRORS = [20, 21, 22, 24, 27, 28, 32, 36, 37, 43, 500];

    public const VALID_VALUES = [
        self::TEST_PAYMENT_FAILED,
        self::SHOP_NOT_ACTIVE,
        self::SHOP_NOT_FOUND,
        self::WRONG_SIGNATURE,
        self::WRONG_PARAM,
        self::WRONG_SUM,
        self::PAYMENT_TIME_EXPIRED,
        self::RECURRING_PAYMENT_NOT_ALLOWED,
        self::RECURRING_PAYMENT_WRONG_PARAM,
        self::INV_ID_NOT_UNIOQUE,
        self::INIT_OPERATION_ERROR,
        self::TEST_ACCOUNT_NUMBER_NOT_ALLOWED_FOR_PAYMENT,
        self::UNKNOWN_CURRENCY,
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
            if (!in_array($value, self::EXTERNAL_SERVICE_ERRORS)) {
                throw new InvalidArgumentException("Неизвестный код ошибки робокассы: $value");
            }
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
