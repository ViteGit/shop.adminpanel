<?php

namespace App\DTO;

use App\VO\Email;

class FeedbackData
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $message
     * @param string $name
     * @param Email $email
     */
    public function __construct(
        string $message,
        string $name,
        Email $email
    ) {
        $this->email = $email;
        $this->message = $message;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
