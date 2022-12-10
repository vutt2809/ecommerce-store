<?php
namespace App\Repositories\Coupon;

use App\Models\Coupon;
use App\Repositories\EloquentRepository;

class CouponRepository extends EloquentRepository implements CouponInterface
{
    public function getModel() {
        return Coupon::class;
    }
}