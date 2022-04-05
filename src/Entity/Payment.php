<?php

namespace App\Entity;

use App\VO\PaymentStatus;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Exception;

/**
 * @ORM\Entity()
 */
class Payment
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
     * @var PaymentMethod
     *
     * @ORM\ManyToOne(targetEntity="PaymentMethod")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")
     */
    private $paymentMethod;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $currencyCode;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $amount;

    /**
     * @var Order
     *
     * @ORM\OneToOne(targetEntity="Order", mappedBy="payment", cascade={"persist"})
     */
    private $order;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, unique=true)
     */
    private $invId;

    /**
     * @var PaymentStatus
     *
     * @ORM\Embedded(class="App\VO\PaymentStatus", columnPrefix="payment_")
     */
    protected $status;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $paymentDate;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $cancelDate;

    /**
     * @param PaymentMethod $paymentMethod
     * @param string $invId
     * @param PaymentStatus $status
     * @param string $currencyCode
     * @param int $amount
     * @throws Exception
     */
    public function __construct(
        PaymentMethod $paymentMethod,
        ?string $invId,
        PaymentStatus $status,
        string $currencyCode,
        int $amount
    ) {
        $this->paymentMethod = $paymentMethod;
        $this->invId = $invId;
        $this->status = $status;
        $this->currencyCode = $currencyCode;
        $this->amount = $amount;
        $this->createdAt = new DateTimeImmutable();
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $invId
     *
     * @return Payment
     */
    public function updateInvId(string $invId): self
    {
        $this->invId = $invId;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvId(): string
    {
        return $this->invId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = new PaymentStatus($status);
    }

    /**
     * @return PaymentStatus
     */
    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->getStatus() == PaymentStatus::PENDING;
    }

    /**
     * @param PaymentStatus $status
     *
     * @return Payment
     */
    public function updateStatus(PaymentStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Payment
     *
     * @throws Exception
     */
    public function updatePaymentDate(): self
    {
        $this->paymentDate = new DateTimeImmutable();

        return $this;
    }

    /**
     * @return Payment
     *
     * @throws Exception
     */
    public function updateCancelDate(): self
    {
        $this->cancelDate = new DateTimeImmutable();

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCancelDate(): ?DateTimeImmutable
    {
        return $this->cancelDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getPaymentDate(): ?DateTimeImmutable
    {
        return $this->paymentDate;
    }
}
