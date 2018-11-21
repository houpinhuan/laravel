<?php

namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyUserAsset extends Model
{
    protected $table = 'agency_user_asset';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}