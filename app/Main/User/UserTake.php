<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserTake extends Model
{
    protected $table = 'user_take';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }
}
