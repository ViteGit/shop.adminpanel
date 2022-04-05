<?php

namespace App\VO\DsPlatformaApi;

class MoneyHistory
{
    private $operationId;
    private $money;
    private $operationType;
    private $operationDate;

    /**
     * @param int $operationId
     * @param int $money
     * @param string $operationType
     * @param string $operationDate
     */
    public function __construct(int $operationId, int $money, string $operationType, string $operationDate)
    {
        $this->operationId = $operationId;
        $this->money = $money;
        $this->operationType = $operationType;
        $this->operationDate = $operationDate;
    }

    /**
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

    /**
     * @return string
     */
    public function getOperationDate(): string
    {
        return $this->operationDate;
    }

    /**
     * @return int
     */
    public function getOperationId(): int
    {
        return $this->operationId;
    }

    /**
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operationType;
    }
}