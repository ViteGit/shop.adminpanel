<?php

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;

/**
 * @Embeddable
 */
class Password
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="password")
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = password_hash($value, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function compare(string $password): bool
    {
        return password_verify($password, $this->value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
