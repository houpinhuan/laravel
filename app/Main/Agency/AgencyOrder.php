<?php

namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyOrder extends Model
{
    protected $table = 'agency_order';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function area(){

        return $this -> hasOne('App\Main\Area\Area','id','areaId');

    }
}
