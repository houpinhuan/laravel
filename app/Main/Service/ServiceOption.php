<?php

namespace App\Main\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    protected $table = 'service_option';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function categoryOption(){

        return $this -> hasOne('App\Main\Category\CategoryOption','id','optionId');

    }
}
