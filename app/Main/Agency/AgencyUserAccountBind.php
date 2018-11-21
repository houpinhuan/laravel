<?php namespace App\Main\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyUserAccountBind extends Model
{
    protected $table = 'agency_user_account_bind';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}