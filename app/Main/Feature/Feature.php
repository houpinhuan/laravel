<?php

namespace App\Main\Feature;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
