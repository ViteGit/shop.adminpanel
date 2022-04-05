<?php

namespace App\Types;

use App\VO\UserStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class TypeUserStatus extends Type
{
    private const TYPE_NAME = 'user_status';

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param string | null $userStatus
     * @param AbstractPlatform $platform
     *
     * @return UserStatus | null
     */
    public function convertToPHPValue($userStatus, AbstractPlatform $platform): ?UserStatus
    {
        return empty($userStatus) ? null : new UserStatus($userStatus);
    }

    /**
     * @param UserStatus | null $file
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

        if (!$file instanceof UserStatus) {
            throw new InvalidArgumentException('Недопустимый тип значения `userStatus`');
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
