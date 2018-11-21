<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    protected $table = 'user_feedback';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasMany('App\Main\User\User','id','userId');

    }
}
