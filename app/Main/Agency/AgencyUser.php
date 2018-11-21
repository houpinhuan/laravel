<?php namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyUser extends Model
{
    protected $table = 'agency_user';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
