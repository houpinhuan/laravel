<?php

namespace App\Main\Complaint;

use Illuminate\Database\Eloquent\Model;

class ComplaintOption extends Model
{
    protected $table = 'complaint_option';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
