<?php

namespace App\Main\Order;

use Illuminate\Database\Eloquent\Model;

class OrderPackageContent extends Model
{
    protected $table = 'order_package_content';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
