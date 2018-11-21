<?php

namespace App\Main\Complaint;

use Illuminate\Database\Eloquent\Model;

class ComplaintOrder extends Model
{
    protected $table = 'complaint_order';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }

    public function user_stylist(){

        return $this -> hasManyThrough('App\Main\User\User','App\Main\Stylist\Stylist','id','id','stylistId','userId');

    }

    public function order(){

        return $this -> hasOne('App\Main\Order\Order','id','orderId');
    }


}
