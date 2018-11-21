<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function userAttach(){

        return $this -> hasOne('App\Main\User\UserAttach','userId','id');

    }

}


