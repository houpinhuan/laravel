<?php namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
//引入trait
use Illuminate\Auth\Authenticatable;

//Manager 继承Model,并且实现接口（laravel是单继承）
class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义当前模型需要关联的数据表
    protected $table = 'manager';

    public $timestamps = false;

    //使用trait，就相当于把整个trait代码段复制到这个位置
    use Authenticatable; 

    public function role() {

    	return $this->hasOne('App\Admin\Role', 'id', 'rid');

    }

}
