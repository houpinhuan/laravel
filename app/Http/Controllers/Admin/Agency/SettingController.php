<?php

namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Agency\AgencySetting;
use Input;

class SettingController extends Controller
{
    public function index(){

        $data = AgencySetting::get();
        return view('admin.agency.agencySetting.index',compact('data'));

    }

    public function update(){

        if (Input::method() == 'POST'){
            AgencySetting::where('id',Input::get('id')) -> update(['awardRate'=>Input::get('awardRate')]);
            return redirect() -> back() -> with('status','编辑成功');
        }else{
            $data = AgencySetting::where('id',Input::get('id')) -> get();
            return view('admin.agency.agencySetting.update',compact('data'));
        }


    }
}
