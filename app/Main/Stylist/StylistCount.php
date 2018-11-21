<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistCount extends Model
{
    protected $table = 'stylist_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
