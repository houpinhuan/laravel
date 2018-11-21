<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreCount extends Model
{
    protected $table = 'store_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
