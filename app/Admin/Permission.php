<?php namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	//定义当前模型需要关联的数据表
    protected $table = "permission";

    public $timestamps = false;
}
