<?php namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	//定义当前模型需要关联的数据表
    protected $table = "role_permission";

    public $timestamps = false;

    public function role() {

    	return $this->hasOne('App\Admin\Role', 'id', 'rid');

    }

    public function permission() {

    	return $this->hasOne('App\Admin\Permission', 'id', 'pid');

    }
}
