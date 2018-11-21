<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistAttach extends Model
{
    protected $table = 'stylist_attach';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
