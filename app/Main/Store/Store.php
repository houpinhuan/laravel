<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }

    public function storeCount(){

        return $this -> hasOne('App\Main\Store\StoreCount','storeId','id');

    }

}
