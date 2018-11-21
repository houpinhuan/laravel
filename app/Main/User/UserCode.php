<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserCode extends Model
{
    protected $table = 'user_code';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
