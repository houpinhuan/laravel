<?php

namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencySetting extends Model
{
    protected $table = 'agency_setting';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
