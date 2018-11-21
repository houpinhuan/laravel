<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PublicController extends Controller
{
    //登陆页面的展示
    public function login(Request $request)
    {
    	return view('admin.public.login');
    }
    public function check(Request $request){
    	//开始自动验证
    	$this -> validate($request,[
    		//验证规则语法
    		'username'	=>	'required|min:2|max:20',
    		'password'	=>	'required|min:6',
    		//captcha 得是合法的验证码
    		'captcha'	=>	'required|size:5|captcha'
    	]);
    	//继续开始身份核实
    	$data = $request -> only(['username', 'password']);
    	$result = Auth::guard('admin') -> attempt($data,$request -> get('online'));
        //php弱类型语言，有值为true，没值为false,确定是否要’记住我’

        if ($request -> get('online')){
            setcookie('username',$request -> input('username'));
            setcookie('password',$request -> input('password'));
        }

        //判断用户是否成功
    	if($result){
    		//跳转到后台页面
    		return redirect('/admin/index/index');
    	}else{
    		//跳转到登录页
    		return redirect('/admin/public/login') -> withErrors(['用户名或密码错误。']);
    	}
    }

    public function logout()
    {
        //退出
        Auth::guard('admin') -> logout();
        //跳转到登录页面
        return redirect('/admin/public/login');
    }
}
