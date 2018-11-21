<?php

namespace App\Http\Controllers\Admin\Hairstyle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Hairstyle\Hairstyle;
use Input;

class HairstyleController extends Controller
{
    //发类列表
    public function index(){

        if (!empty(Input::get('datemin'))){
            $datemin = Input::get('datemin');
            $where[] = ['createtime','>=',date('Y-m-d H:i:s',strtotime($datemin))];
        }
        if (!empty(Input::get('datemax'))){
            $datemax = Input::get('datemax');
            $where[] = ['createtime','<=',date('Y-m-d H:i:s',strtotime($datemax)+86400)];
        }
        if (!empty($where)){
            $data = Hairstyle::where($where) -> get();
        }else{
            $data = Hairstyle::get();
        }
        return view('admin.hairstyle.index',compact('data','datemin','datemax'));

    }

    public function update(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'发类名称是必填字段',
                'describe.required'=>'发类描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['updatetime'] = date('Y-m-d H:i:s');
            Hairstyle::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() -> with('status','编辑成功！');
        }else{
            $data = Hairstyle::where('id',Input::get('id')) -> get();
            return view('admin.hairstyle.update',compact('data'));
        }

    }

    public function add(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'发类名称是必填字段',
                'describe.required'=>'发类描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['createtime'] = date('Y-m-d H:i:s');
            Hairstyle::insert($data);
            return redirect() -> back() ->with('status','添加成功！');
        }else{
            return view('admin.hairstyle.add',compact('data'));
        }

    }
}
