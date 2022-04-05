<?php

namespace App\DTO;

use App\VO\Email;
use App\VO\Password;
use App\VO\PhoneNumber;
use DateTimeImmutable;

class RegistrationData
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $fio;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var PhoneNumber
     */
    private $phone;

    /**
     * @var string | null
     */
    private $city;

    /**
     * @var string | null
     */
    private $address;

    /**
     * @var string | null
     */
    private $postCode;

    /**
     * @var Password
     */
    private $password;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var DateTimeImmutable | null
     */
    private $dateOfBirthday;

    /**
     * @param string $login
     * @param string $fio
     * @param Email $email
     * @param PhoneNumber $phone
     * @param string|null $gender
     * @param DateTimeImmutable|null $dateOfBirthday
     * @param string $city
     * @param string $address
     * @param string $postCode
     * @param Password $password
     */
    public function __construct(
        string $login,
        string $fio,
        Email $email,
        PhoneNumber $phone,
        ?string $gender,
        ?DateTimeImmutable $dateOfBirthday,
        ?string $city,
        ?string $address,
        ?string $postCode,
        Password $password
    ) {
        $this->login = $login;
        $this->fio = $fio;
        $this->email = $email;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->dateOfBirthday = $dateOfBirthday;
        $this->city = $city;
        $this->address = $address;
        $this->postCode = $postCode;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string | null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @return DateTimeImmutable | null
     */
    public function getDateOfBirthday(): ?DateTimeImmutable
    {
        return $this->dateOfBirthday;
    }
}
