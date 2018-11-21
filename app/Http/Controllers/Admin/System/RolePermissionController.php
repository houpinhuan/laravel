<?php namespace App\Http\Controllers\Admin\System;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\RolePermission;

class RolePermissionController extends Controller
{

    public function index(Request $request) {

        $rid = $request->input('rid', '');

        if ($rid > 0)
        {
            $data = RolePermission::where('rid', $rid)->get();
        } else {
            $data = RolePermission::get();
        }

    	return view('admin.system.rolepermission.index', compact('data', 'rid'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
            $data = $request->only(['rid', 'pid']);

            try {
                RolePermission::insert($data);
            } catch (\Exception $e) {

            }

            return redirect()->back()->with('status', '添加成功！');

    	} else {

    		return view('admin.system.rolepermission.add');

    	}

    }

    public function update(Request $request) {

    	if ($request->isMethod('post'))
    	{

            $data = $request->only(['rid', 'pid']);
    		
            try {
                RolePermission::where('id', $request->input('id'))->update($data);
            } catch (\Exception $e) {

            }

            return redirect()->back()->with('status', '编辑成功！');

    	} else {

    		$data = RolePermission::where('id', $request->input('id'))->first();
            return view('admin.system.rolepermission.update', compact('data'));

    	}

    }

}