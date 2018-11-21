<?php

namespace App\Main\Order;

use Illuminate\Database\Eloquent\Model;

class OrderPay extends Model
{
    protected $table = 'order_pay';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
