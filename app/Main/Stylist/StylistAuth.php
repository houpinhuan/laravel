<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistAuth extends Model
{
    protected $table = 'stylist_auth';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
