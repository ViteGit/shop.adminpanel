<?php

namespace App\DTO;


use App\Entity\Coupon;

class CouponData
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * @return Coupon
     */
    public function getCoupon(): Coupon
    {
        return $this->coupon;
    }
}
