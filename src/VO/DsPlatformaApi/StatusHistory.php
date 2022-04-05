<?php

namespace App\VO\DsPlatformaApi;

class StatusHistory
{
    /**
     * @var int
     */
    private $statusId;

    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $label;

    /**
     * @param int $statusId
     * @param \DateTimeImmutable $date
     * @param string $label
     */
    public function __construct(int $statusId, \DateTimeImmutable $date, string $label)
    {
        $this->statusId = $statusId;
        $this->date = $date;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }
}
