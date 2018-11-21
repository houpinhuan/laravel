<?php

namespace App\Main\Service;

use Illuminate\Database\Eloquent\Model;

class ServicePackageContent extends Model
{
    protected $table = 'service_package_content';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function category(){

        return $this -> hasOne('App\Main\Category\Category','id','categoryId');

    }

    public function categoryOption(){

        return $this -> hasOne('App\Main\Category\CategoryOption','id','optionId');

    }
}
