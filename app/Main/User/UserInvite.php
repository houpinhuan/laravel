<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    protected $table = 'user_invite';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','inviteUserId');

    }

}
