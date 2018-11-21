<?php

namespace App\Main\DataConf;

use Illuminate\Database\Eloquent\Model;

class DataConf extends Model
{
    protected $table = 'data_conf';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
