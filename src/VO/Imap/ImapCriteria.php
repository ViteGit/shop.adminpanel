<?php

namespace App\VO\Imap;

use Symfony\Component\Routing\Exception\InvalidParameterException;

class ImapCriteria
{
    private $value;

    public const ALL = 'ALL';
    public const ANSWERED = 'ANSWERED';
    public const BCC = 'BCC';
    public const BEFORE = 'BEFORE';
    public const BODY = 'ALL';
    public const CC = 'CC';
    public const DELETED = 'DELETED';
    public const FLAGGED = 'FLAGGED';
    public const FROM = 'FROM';
    public const KEYWORD = 'KEYWORD';
    public const NEW = 'NEW';
    public const OLD = 'OLD';
    public const ON = 'ON';
    public const RECENT = 'RECENT';
    public const SEEN = 'SEEN';
    public const SINCE = 'SINCE';
    public const SUBJECT = 'SUBJECT';
    public const TEXT = 'TEXT';
    public const TO = 'TO';
    public const UNANSWERED = 'UNANSWERED';
    public const UNDELETED = 'UNDELETED';
    public const UNFLAGGED = 'UNFLAGGED';
    public const UNKEYWORD = 'UNKEYWORD';
    public const UNSEEN = 'UNSEEN';

    private const CRITERIAS = [
        self::ALL,
        self::ANSWERED,
        self::BCC,
        self::BEFORE,
        self::BODY,
        self::CC,
        self::DELETED,
        self::FLAGGED,
        self::FROM,
        self::KEYWORD,
        self::NEW,
        self::OLD,
        self::ON,
        self::RECENT,
        self::SEEN,
        self::SINCE,
        self::SUBJECT,
        self::TO,
        self::TEXT,
        self::UNANSWERED,
        self::UNDELETED,
        self::UNFLAGGED,
        self::UNKEYWORD,
        self::UNSEEN,
    ];

    public function __construct(string $value)
    {
            if (!in_array($value,self::CRITERIAS)) {
                throw new InvalidParameterException("Неверный параметр = $value",0);
            }
    }

    /**
     * @return mixed
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
