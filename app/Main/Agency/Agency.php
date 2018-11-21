<?php namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agency';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user() {

    	return $this->hasOne('App\Main\Agency\AgencyUser', 'id', 'agencyuserId');

    }

    public function area() {

        return $this->hasOne('App\Main\Area\Area', 'id', 'areaId');

    }
}
