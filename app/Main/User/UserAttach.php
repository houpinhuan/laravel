<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserAttach extends Model
{
    protected $table = 'user_attach';

    protected $connection = 'mysql_main';

    public $timestamps = false;

}
