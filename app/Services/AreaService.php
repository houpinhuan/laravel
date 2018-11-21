<?php namespace App\Services;


use App\Main\Area\Area;

class AreaService
{

	public function getProvinceList() {

		return Area::where('level', 1)->get();

	} 

	public function getCityList($provinceId) {

		if ($provinceId > 0)
		{
			return Area::where('level', 2)->where('parentId', $provinceId)->get();
		} else {
			return [];
		}

	}

	public function getDistrictList($cityId) {

		if ($cityId > 0)
		{
			return Area::where('level', 3)->where('parentId', $cityId)->get();
		} else {
			return [];
		}

	}

	public function getList() {

		return Area::get();

	}

}