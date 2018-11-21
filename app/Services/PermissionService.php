<?php namespace App\Services;


use App\Admin\Permission;

class PermissionService
{

	public function getList($rid) {

		return Permission::get();

	} 

}