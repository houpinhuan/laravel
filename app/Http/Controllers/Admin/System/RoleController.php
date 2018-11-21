<?php namespace App\Http\Controllers\Admin\System;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\Role;

class RoleController extends Controller
{

    public function index() {

    	$data = Role::get();

    	return view('admin.system.role.index', compact('data'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'name' => 'required'
            ],[
                'name.required' => '角色名称是必填字段'
            ]);

            $data = $request->only(['name']);
            $data['updatetime'] = $data['datetime'] = date('Y-m-d H:i:s');
            Role::insert($data);

            return redirect()->back()->with('status', '添加成功！');

    	} else {

    		return view('admin.system.role.add');

    	}

    }

    public function update(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'name' => 'required'
            ],[
                'name.required' => '角色名称是必填字段'
            ]);

            $data = $request->only(['name']);
            $data['updatetime'] = date('Y-m-d H:i:s');
            Role::where('id', $request->input('id'))->update($data);

            return redirect()->back()->with('status', '编辑成功！');

    	} else {

    		$data = Role::where('id', $request->input('id'))->first();
            return view('admin.system.role.update', compact('data'));

    	}

    }

}