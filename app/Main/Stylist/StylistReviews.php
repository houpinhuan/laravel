<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistReviews extends Model
{
    protected $table = 'stylist_reviews';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
