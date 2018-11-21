<?php namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
	//定义当前模型需要关联的数据表
    protected $table = "role_menu";

    public $timestamps = false;

    public function role() {

    	return $this->hasOne('App\Admin\Role', 'id', 'rid');

    }

    public function menu() {

    	return $this->hasOne('App\Admin\Menu', 'id', 'mid');

    }
}
