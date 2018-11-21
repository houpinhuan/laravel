<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $table = 'store_setting';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
