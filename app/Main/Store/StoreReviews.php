<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreReviews extends Model
{
    protected $table = 'store_reviews';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
