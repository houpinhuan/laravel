<?php namespace App\Services;


use App\Admin\Menu;
use App\Admin\RoleMenu;

class MenuService
{

	public function getParentList($rid) {

		return Menu::where('pid', '0')->get();

	} 

	public function getSonList($rid) {

		return Menu::where('pid', '!=', '0')->get();

	}

	public function getList($rid) {

		return Menu::get();

	}

}