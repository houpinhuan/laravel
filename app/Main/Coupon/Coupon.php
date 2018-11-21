<?php

namespace App\Main\Coupon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
