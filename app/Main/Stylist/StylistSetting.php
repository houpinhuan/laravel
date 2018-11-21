<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistSetting extends Model
{
    protected $table = 'stylist_setting';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function store(){

        return $this -> hasMany('App\Main\Store\Store','id','storeId');

    }
}
