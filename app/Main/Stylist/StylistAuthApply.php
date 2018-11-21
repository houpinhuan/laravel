<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistAuthApply extends Model
{
    protected $table = 'stylist_auth_apply';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function stylist() {

    	return $this->hasOne('App\Main\Stylist\Stylist', 'id', 'stylistId');

    }

}
