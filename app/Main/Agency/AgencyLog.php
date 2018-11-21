<?php

namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyLog extends Model
{
    protected $table = 'agency_log';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function agencyUser(){

        return $this->hasOne('App\Main\Agency\AgencyUser','id','agencyuserId');

    }

    public function user(){

        return $this->hasOne('App\Main\User\User','id','joinUserId');

    }

    public function store(){

        return $this->hasOne('App\Main\Store\Store','id','joinStoreId');

    }

    public function order(){

        return $this->hasOne('App\Main\Order\Order','id','joinOrderId');

    }


}