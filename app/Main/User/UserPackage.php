<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $table = 'user_package';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function servicePackage(){

        return $this -> hasOne('App\Main\Service\ServicePackage','id','packageId');

    }

    public function user(){

        return $this -> hasManyThrough('App\Main\User\User','App\Main\Stylist\Stylist','id','id','stylistId','userId');

    }
}
