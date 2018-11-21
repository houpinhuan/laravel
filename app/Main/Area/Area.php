<?php

namespace App\Main\Area;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
