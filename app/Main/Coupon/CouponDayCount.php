<?php

namespace App\Main\Coupon;

use Illuminate\Database\Eloquent\Model;

class CouponDayCount extends Model
{
    protected $table = 'coupon_day_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
