<?php

namespace App\DTO;

use App\VO\Email;

class ReviewData
{
    /**
     * @var int
     */
    protected $rating;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var Email
     */
    protected $email;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * @var int
     */
    private $productId;

    /**
     * @param int $rating
     * @param string $comment
     * @param Email $email
     * @param string $nickname
     * @param int $productId
     */
    public function __construct(
        int $rating,
        string $comment,
        Email $email,
        string $nickname,
        int $productId
    ) {
        $this->rating = $rating;
        $this->comment = $comment;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }
}
