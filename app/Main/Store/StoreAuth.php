<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreAuth extends Model
{
    protected $table = 'store_auth';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
