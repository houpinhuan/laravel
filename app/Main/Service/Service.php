<?php

namespace App\Main\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function category(){

        return $this -> hasOne('App\Main\Category\Category','id','categoryId');

    }
}
