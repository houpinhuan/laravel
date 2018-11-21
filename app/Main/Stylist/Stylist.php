<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    protected $table = 'stylist';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }

    public function stylistCount(){

        return $this -> hasOne('App\Main\Stylist\StylistCount','stylistId','id');

    }
}
