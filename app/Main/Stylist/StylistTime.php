<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistTime extends Model
{
    protected $table = 'stylist_time';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
