<?php

namespace App\DTO\Robokassa;

class PaymentData
{

    /**
     * @var int
     */
    private $outSum;

    /**
     * @var int
     */
    private $invId;

    /**
     * @var string
     */
    private $signature;

    /**
     * @param int $outSum
     * @param int $invId
     * @param string $signature
     */
    public function __construct(int $outSum, int $invId, string $signature)
    {
        $this->invId = $invId;
        $this->outSum = $outSum;
        $this->signature = $signature;
    }

    /**
     * @return int
     */
    public function getInvId(): int
    {
        return $this->invId;
    }

    /**
     * @return int
     */
    public function getOutSum(): int
    {
        return $this->outSum;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }
}
