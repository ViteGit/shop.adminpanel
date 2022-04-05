<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Image
{
    public const ORIGINAL = 'original';
    public const THUMBNAIL = 'thumbnail';

    public const VALID_TYPES = [
        self::ORIGINAL,
        self::THUMBNAIL,
    ];

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $path;


    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @param string $path
     * @param string $type
     */
    public function __construct(string $path, string $type)
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new \InvalidArgumentException('Недопустимый тип изоброжения');
        }

        $this->type = $type;
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->path;
    }
}
