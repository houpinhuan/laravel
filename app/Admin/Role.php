<?php namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //定义当前模型需要关联的数据表
    protected $table = "role";

    public $timestamps = false;
}
