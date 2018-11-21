<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $table = 'user_location';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
