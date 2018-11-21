<?php namespace App\Http\Controllers\Admin\System;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Admin\Manager;

class ManagerController extends Controller
{

    public function index() {

    	$data = Manager::get();

    	return view('admin.system.manager.index', compact('data'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'username' => 'required',
                'password' => 'required',
                'realname' => 'required',
                'mobile' => 'required',
                'rid' => 'required',
            ],[
                'username.required' => '账号是必填字段',
                'password.required' => '密码是必填字段',
                'realname.required' => '真实名称是必填字段',
                'mobile.required' => '手机号码是必填字段',
                'rid.required' => '角色是必填字段',
            ]);

            $data = $request->only(['username', 'password', 'realname', 'mobile', 'rid']);
            $data['password'] = Hash::make($data['password']);
            $data['updatetime'] = $data['datetime'] = date('Y-m-d H:i:s');
            Manager::insert($data);

            return redirect()->back()->with('status', '添加成功！');

    	} else {

    		return view('admin.system.manager.add');

    	}

    }

    public function update(Request $request) {

    	if ($request->isMethod('post'))
    	{
    		$this -> validate($request, [
                'username' => 'required',
                'realname' => 'required',
                'mobile' => 'required',
                'rid' => 'required',
            ],[
                'username.required' => '账号是必填字段',
                'realname.required' => '真实名称是必填字段',
                'mobile.required' => '手机号码是必填字段',
                'rid.required' => '角色是必填字段',
            ]);

            $data = $request->only(['username', 'password', 'realname', 'mobile', 'rid']);
            if (! empty($data['password']))
            {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $data['updatetime'] = date('Y-m-d H:i:s');
            Manager::where('id', $request->input('id'))->update($data);

            return redirect()->back()->with('status', '编辑成功！');

    	} else {

    		$data = Manager::where('id', $request->input('id'))->first();
            return view('admin.system.manager.update', compact('data'));

    	}

    }

}