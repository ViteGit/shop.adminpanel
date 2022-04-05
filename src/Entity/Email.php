<?php

namespace App\Entity;

use App\VO\Imap\ImapCriteria;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

class Email
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $emailId;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $subject;

    /**
     * @ORM\Column(type="string")
     */
    private $body;

    /**
     * @ORM\Column(type="string")
     */
    private $from;

    /**
     * @var
     *
     * @ORM\Column(type="string")
     */
    private $directory;

    /**
     * @param string $emailId
     * @param string $subject
     * @param string $body
     * @param string $from
     * @param DateTimeImmutable $date
     * @param ImapCriteria $criteria
     * @param string $directory
     */
    public function __construct(
        string $emailId,
        string $subject,
        string $body,
        string $from,
        DateTimeImmutable $date,
        ImapCriteria $criteria,
        string $directory
    ){
        $this->emailId = $emailId;
        $this->subject = $subject;
        $this->body = $body;
        $this->from = $from;
        $this->date = $date;
        $this->directory = $directory;
        $this->status = $criteria->getValue();
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getEmailId(): int
    {
        return $this->emailId;
    }

    /**
     * @return ImapCriteria
     */
    public function getStatus(): ImapCriteria
    {
        return $this->status;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param ImapCriteria $criteria
     *
     * @return Email
     */
    public function setStatus(ImapCriteria $criteria): self
    {
        $this->status = $criteria->getValue();

        return $this;
    }
}
