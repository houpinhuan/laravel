<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserInviteCount extends Model
{
    protected $table = 'user_invite_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
