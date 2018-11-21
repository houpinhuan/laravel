<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserAsset extends Model
{
    protected $table = 'user_asset';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
