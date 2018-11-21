<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistMonthCount extends Model
{
    protected $table = 'stylist_month_count';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
