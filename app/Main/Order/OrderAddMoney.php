<?php

namespace App\Main\Order;

use Illuminate\Database\Eloquent\Model;

class OrderAddMoney extends Model
{
    protected $table = 'order_add_money';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
