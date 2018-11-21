<?php

namespace App\Main\Order;

use Illuminate\Database\Eloquent\Model;

class OrderRefund extends Model
{
    protected $table = 'order_refund';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
