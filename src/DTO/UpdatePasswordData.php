<?php

namespace App\DTO;

use App\VO\Email;
use App\VO\Password;

class UpdatePasswordData
{
    /**
     * @var Password
     */
    private $password;

    /**
     * @param Password $password
     */
    public function __construct(Password $password)
    {
        $this->password = $password;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
