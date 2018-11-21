<?php

namespace App\Main\Store;

use Illuminate\Database\Eloquent\Model;

class StoreReviewsAttach extends Model
{
    protected $table = 'store_reviews_attach';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
