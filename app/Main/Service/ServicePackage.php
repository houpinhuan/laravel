<?php

namespace App\Main\Service;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    protected $table = 'service_package';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
