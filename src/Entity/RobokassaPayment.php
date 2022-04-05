<?php

namespace App\Entity;

use App\VO\PaymentStatus;
use App\VO\Robokassa\ResponseStatus;
use Exception;

class RobokassaPayment extends Payment
{
    /**
     * @var ResponseStatus
     *
     * @ORM\Embedded(class="App\VO\ResponseStatus", columnPrefix="response_")
     */
    private $responseStatus;

    /**
     * @param PaymentMethod $paymentMethod
     * @param string $invId
     * @param PaymentStatus $status
     * @param string $currencyCode
     * @param int $amount
     * @param ResponseStatus $responseStatus
     *
     * @throws Exception
     */
    public function __construct(
        PaymentMethod $paymentMethod,
        string $invId,
        PaymentStatus $status,
        string $currencyCode,
        int $amount,
        ResponseStatus $responseStatus
    ) {
        $this->responseStatus = $responseStatus;

        parent::__construct($paymentMethod, $invId, $status, $currencyCode, $amount);
    }

    /**
     * @param ResponseStatus $responseStatus
     *
     * @return RobokassaPayment
     */
    public function updateResponseStatus(ResponseStatus $responseStatus): self
    {
        $this->responseStatus = $responseStatus;

        return $this;
    }

    /**
     * @return ResponseStatus
     */
    public function getResponseStatus(): ResponseStatus
    {
        return $this->responseStatus;
    }
}
