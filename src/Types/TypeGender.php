<?php

namespace App\Types;

use App\VO\Gender;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class TypeGender extends Type
{
    private const TYPE_NAME = 'gender';

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
     * @param $gender
     * @param AbstractPlatform $platform
     *
     * @return Gender | null
     */
    public function convertToPHPValue($gender, AbstractPlatform $platform): ?Gender
    {
        return empty($gender) ? null : new Gender($gender);
    }

    /**
     * @param Gender | null     $file
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

        if (!$file instanceof Gender) {
            throw new InvalidArgumentException('Недопустимый тип значения `gender`');
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
