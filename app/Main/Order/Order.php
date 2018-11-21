<?php

namespace App\Main\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $connection = 'mysql_main';

    public $timestamps = false;

    public function user(){

        return $this -> hasOne('App\Main\User\User','id','userId');

    }
    public function store(){

        return $this -> hasOne('App\Main\Store\Store','id','storeId');

    }
    public function stylist(){

        return $this -> hasManyThrough('App\Main\User\User','App\Main\Stylist\Stylist','id','id','stylistId','userId');

    }

    public function service(){

        return $this -> hasOne('App\Main\Service\Service','id','serviceId');

    }

    public function servicePackage(){

        return $this -> hasOne('App\Main\Service\ServicePackage','id','packageId');

    }

    public function orderPay(){

        return $this -> hasOne('App\Main\Order\OrderPay','orderId','id');

    }

    public function orderRefund(){

        return $this -> hasOne('App\Main\Order\OrderRefund','orderId','id');

    }
}
