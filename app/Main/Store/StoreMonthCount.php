<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreMonthCount extends Model
{
    protected $table = 'store_month_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
