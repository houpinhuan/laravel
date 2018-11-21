<?php

namespace App\Http\Controllers\Admin\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Feature\Feature;
use Input;

class FeatureController extends Controller
{
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
            $data = Feature::where($where) -> get();
        }else{
            $data = Feature::get();
        }
        return view('admin.feature.index',compact('data','datemin','datemax'));

    }

    public function update(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'脸型名称是必填字段',
                'describe.required'=>'脸型描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['updatetime'] = date('Y-m-d H:i:s');
            Feature::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() -> with('status','编辑成功！');
        }else{
            $data = Feature::where('id',Input::get('id')) -> get();
            return view('admin.feature.update',compact('data'));
        }

    }

    public function add(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'脸型名称是必填字段',
                'describe.required'=>'脸型描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['createtime'] = date('Y-m-d H:i:s');
            Feature::insert($data);
            return redirect() -> back() ->with('status','添加成功！');
        }else{
            return view('admin.feature.add',compact('data'));
        }

    }
}
