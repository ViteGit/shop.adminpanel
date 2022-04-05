<?php

namespace App\Types;

use App\VO\PhoneNumber;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class TypePhoneNumber extends Type
{
    private const TYPE_NAME = 'phone_number';

    /**
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param string | null    $phoneNumber
     * @param AbstractPlatform $platform
     *
     * @return PhoneNumber | null
     */
    public function convertToPHPValue($phoneNumber, AbstractPlatform $platform): ?PhoneNumber
    {
        return empty($phoneNumber) ? null : new PhoneNumber($phoneNumber);
    }

    /**
     * @param PhoneNumber | null $phoneNumber
     * @param AbstractPlatform   $platform
     *
     * @return string | null
     *
     * @throws InvalidArgumentException
     */
    public function convertToDatabaseValue($phoneNumber, AbstractPlatform $platform): ?string
    {
        if (null === $phoneNumber) {
            return null;
        }

        if (!$phoneNumber instanceof PhoneNumber) {
            throw new InvalidArgumentException('Недопустимый тип значения phone_number');
        }

        return $phoneNumber;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::TYPE_NAME;
    }
}
