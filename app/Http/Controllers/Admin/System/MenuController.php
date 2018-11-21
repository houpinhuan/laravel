<?php namespace App\Http\Controllers\Admin\System;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\Menu;

class MenuController extends Controller
{

    public function index() {

    	$data = Menu::get();

    	return view('admin.system.menu.index', compact('data'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'name' => 'required'
            ],[
                'name.required' => '菜单名称是必填字段'
            ]);

            $data = $request->only(['name', 'action', 'pid', 'class']);
            $data['updatetime'] = $data['datetime'] = date('Y-m-d H:i:s');
            Menu::insert($data);

            return redirect()->back()->with('status', '添加成功！');

    	} else {

    		return view('admin.system.menu.add');

    	}

    }

    public function update(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'name' => 'required'
            ],[
                'name.required' => '菜单名称是必填字段'
            ]);

            $data = $request->only(['name', 'action', 'pid', 'class']);
            $data['updatetime'] = date('Y-m-d H:i:s');
            Menu::where('id', $request->input('id'))->update($data);

            return redirect()->back()->with('status', '编辑成功！');

    	} else {

    		$data = Menu::where('id', $request->input('id'))->first();
            return view('admin.system.menu.update', compact('data'));

    	}

    }

}