<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreAttach extends Model
{
    protected $table = 'store_attach';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
