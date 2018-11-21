<?php

namespace App\Main\User;

use Illuminate\Database\Eloquent\Model;

class UserAssetLog extends Model
{
    protected $table = 'user_asset_log';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }
}
