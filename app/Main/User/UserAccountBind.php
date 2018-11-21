<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserAccountBind extends Model
{
    protected $table = 'user_account_bind';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
