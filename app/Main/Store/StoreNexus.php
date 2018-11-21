<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreNexus extends Model
{
    protected $table = 'store_nexus';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function stylist(){

        return $this -> hasMany('App\Main\Stylist\Stylist','id','stylistId');

    }

    public function user(){

        return $this -> hasManyThrough('App\Main\User\User','App\Main\Stylist\Stylist','id','id','stylistId','userId');

    }

}
