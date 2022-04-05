<?php

namespace App\Entity;

use App\VO\MethodStatus;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;

abstract class Method
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
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @param string $label
     * @param string $code
     * @param string $description
     * @param bool $active
     * @throws Exception
     */
    public function __construct(string $label, string $code, string $description, bool $active)
    {
        $this->label = $label;
        $this->code = $code;
        $this->description = $description;
        $this->active = $active;
        $this->createdAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $label
     *
     * @return Method
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return Method
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param bool $active
     * @return Method
     */
    public function setStatus(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @param string $code
     *
     * @return Method
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param $active
     *
     * @return Method
     */
    public function setActive($active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->label;
    }
}
