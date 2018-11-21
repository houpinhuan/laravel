<?php

namespace App\Main\Stylist;

use Illuminate\Database\Eloquent\Model;

class StylistReviewsAttach extends Model
{
    protected $table = 'stylist_reviews_attach';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
