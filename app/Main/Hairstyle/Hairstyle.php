<?php

namespace App\Main\Hairstyle;

use Illuminate\Database\Eloquent\Model;

class Hairstyle extends Model
{
    protected $table = 'hairstyle';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
