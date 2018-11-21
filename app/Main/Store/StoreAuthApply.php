<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreAuthApply extends Model
{
    protected $table = 'store_auth_apply';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function store(){

        return $this -> hasOne('App\Main\Store\Store', 'id', 'storeId');

    }
}
