<?php

namespace App\Types;

use App\VO\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class TypeEmail extends Type
{
    private const TYPE_NAME = 'email';

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
     * @param string | null    $email
     * @param AbstractPlatform $platform
     *
     * @return Email | null
     */
    public function convertToPHPValue($email, AbstractPlatform $platform): ?Email
    {
        return empty($email) ? null : new Email($email);
    }

    /**
     * @param Email | null     $file
     * @param AbstractPlatform $platform
     *
     * @return string | null
     *
     * @throws InvalidArgumentException
     */
    public function convertToDatabaseValue($file, AbstractPlatform $platform): ?string
    {
        if (null === $file) {
            return null;
        }

        if (!$file instanceof Email) {
            throw new InvalidArgumentException('Недопустимый тип значения `email`');
        }

        return $file;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::TYPE_NAME;
    }
}
