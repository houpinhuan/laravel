<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Category\Category;
use App\Main\Category\CategoryOption;
use Input;

class CategoryController extends Controller
{
    //类目列表
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
            $data = Category::where($where) -> get();
        }else{
            $data = Category::get();
        }
        return view('admin.category.index',compact('data','datemin','datemax'));

    }

    //添加类目
    public function add(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'类目名称是必填字段',
                'describe.required'=>'类目描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['createtime'] = date('Y-m-d H:i:s');
            Category::insert($data);
            return redirect() -> back() -> with('status','添加成功！');
        }else{
            return view('admin.category.add');
        }
        
    }

    public function update(Request $request){

        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'name'=>"required",
                'describe'=>"required",
            ],[
                'name.required'=>'类目名称是必填字段',
                'name.unique'=>'类目名称已存在',
                'describe.required'=>'类目描述是必填字段'
            ]);
            $data = Input::except('_token');
            $data['updatetime'] = date('Y-m-d H:i:s');
            Category::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() -> with('status','编辑成功！');
        }else{
            $data = Category::where('id',Input::get('id')) -> get();
            return view('admin.category.update',compact('data'));
        }

    }

    //类目选项
    public function option(){

        $data = CategoryOption::where('categoryId',Input::get('id')) -> get();
        return view('admin.category.option',compact('data'));

    }
}
