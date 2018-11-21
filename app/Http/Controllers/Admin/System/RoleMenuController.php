<?php namespace App\Http\Controllers\Admin\System;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\RoleMenu;

class RoleMenuController extends Controller
{

    public function index(Request $request) {

        $rid = $request->input('rid', '');

        if ($rid > 0)
        {
            $data = RoleMenu::where('rid', $rid)->get();
        } else {
            $data = RoleMenu::get();
        }

    	return view('admin.system.rolemenu.index', compact('data', 'rid'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
            $data = $request->only(['rid', 'mid']);

            try {
                RoleMenu::insert($data);
            } catch (\Exception $e) {

            }

            return redirect()->back()->with('status', '添加成功！');

    	} else {

    		return view('admin.system.rolemenu.add');

    	}

    }

    public function update(Request $request) {

    	if ($request->isMethod('post'))
    	{

            $data = $request->only(['rid', 'mid']);
    		
            try {
                RoleMenu::where('id', $request->input('id'))->update($data);
            } catch (\Exception $e) {

            }

            return redirect()->back()->with('status', '编辑成功！');

    	} else {

    		$data = RoleMenu::where('id', $request->input('id'))->first();
            return view('admin.system.rolemenu.update', compact('data'));

    	}

    }

}