<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistCoupon extends Model
{
    protected $table = 'stylist_coupon';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
