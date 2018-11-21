<?php

namespace App\Main\Coin;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $table = 'coin';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
