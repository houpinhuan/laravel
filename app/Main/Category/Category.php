<?php

namespace App\Main\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
