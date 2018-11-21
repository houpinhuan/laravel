<?php

namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyUserTake extends Model
{
    protected $table = 'agency_user_take';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this->hasOne('App\Main\Agency\AgencyUser','id','agencyuserId');

    }
}