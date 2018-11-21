<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    protected $table = 'store_category';

    protected $connection = 'mysql_main';

    public $timestamps = false;

}
