<?php

namespace App\Main\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryOption extends Model
{
    protected $table = 'category_option';

    protected $connection = 'mysql_main';

    public $timestamps = false;
}
