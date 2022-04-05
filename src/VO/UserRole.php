<?php

namespace App\VO;

class UserRole
{
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @var string
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
