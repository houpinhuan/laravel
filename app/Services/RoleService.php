<?php namespace App\Services;


use App\Admin\Role;

class RoleService
{

	public function getList($rid) {

		return Role::get();

	} 

}