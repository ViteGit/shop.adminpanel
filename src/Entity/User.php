<?php

namespace App\Entity;

use App\VO\Email;
use App\VO\Gender;
use App\VO\Password;
use App\VO\PhoneNumber;
use App\VO\UserStatus;
use App\VO\UserRole;
use Doctrine\Common\Collections\ArrayCollection;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fio;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $emailVerificationToken;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $passwordResetToken;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @var UserStatus
     *
     * @ORM\Column(type="user_status", name="status")
     */
    protected $status;

    /**
     * @var Email | null
     *
     * @ORM\Column(type="email", name="email")
     */
    private $email;

    /**
     * @var Gender | null
     *
     * @ORM\Column(type="gender", name="gender")
     */
    private $gender;

    /**
     * @var PhoneNumber
     *
     * @ORM\Column(type="phone_number", length=255, name="phone", unique=true, nullable=true)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="user", cascade={"persist", "remove"})
     */
    private $orders;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @param string $username
     * @param string $fio
     * @param Email $email
     * @param PhoneNumber $phoneNumber
     * @param Password $password
     * @param array $userRoles
     * @param Gender $gender
     * @param int $points
     * @throws Exception
     */
    public function __construct(
        string $username,
        string $fio,
        Email $email,
        PhoneNumber $phoneNumber,
        Password $password,
        array $userRoles,
        Gender $gender,
        int $points = 0
    ) {
        $this->gender = $gender;
        $this->username = $username;
        $this->fio = $fio;
        $this->email = $email;
        $this->email = $email;
        $this->phone = $phoneNumber;
        $this->password = $password;
        $this->roles = $userRoles;
        $this->createdAt = new DateTimeImmutable();
        $this->orders = new ArrayCollection([]);
        $this->emailVerificationToken = $this->generateToken();
        $this->points = $points;
        $this->status = new UserStatus(UserStatus::NOT_ACTIVE);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Email | null
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @param Email | null $email
     *
     * @return User
     */
    public function setEmail(?Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     *
     * @return User
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string | null $password
     *
     * @return User
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return DateTimeImmutable | null
     */
    public function getLastLogin(): ?DateTimeImmutable
    {
        return $this->lastLogin;
    }

    /**
     * @throws Exception
     */
    public function setLastLogin(): self
    {
        $this->lastLogin = new DateTimeImmutable();

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmailVerificationToken(): ?string
    {
        return $this->emailVerificationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailVerificationToken(?string $verificationToken): void
    {
        $this->emailVerificationToken = $verificationToken;
    }

    /**
     * @return string | null
     */
    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    /**
     * @return User
     * @throws Exception
     */
    public function setPasswordResetToken(): self
    {
        $this->passwordResetToken = $this->generateToken();

        return $this;
    }

    /**
     * @return User
     */
    public function dropPasswordResetToken(): self
    {
        $this->passwordResetToken = null;

        return $this;
    }

    /**
     * @param UserRole $role
     *
     * @return bool
     */
    public function hasRole(UserRole $role): bool
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * @param string $role
     *
     * @return User
     */
    public function addRole(string $role): self
    {
        $role = strtoupper($role);
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $role
     *
     * @return User
     */
    public function removeRole(string $role): self
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return void
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return UserStatus
     */
    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param UserStatus $status
     *
     * @return User
     */
    public function updateStatus(UserStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getUsername();
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    public function generateToken(): string
    {
        return md5(time() . random_bytes(32));
    }

    /**
     * @param int $points
     *
     * @return User
     */
    public function updatePoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }
}
