<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    protected $table = 'store_location';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
