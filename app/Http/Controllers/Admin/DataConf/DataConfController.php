<?php

namespace App\Http\Controllers\Admin\DataConf;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\DataConf\DataConf;
use Input;

class DataConfController extends Controller
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
            $data = DataConf::where($where) -> get();
        }else{
            $data = DataConf::get();
        }
        return view('admin.dataConf.index',compact('data','datemin','datemax'));

    }

    public function add(){

        if (Input::method() == 'POST'){
            $data = Input::except('_token');
            $data['createtime'] = date('Y-m-d H:i:s');
            DataConf::insert($data);
            return redirect() -> back() -> with('status','添加成功！');
        }else{
            return view('admin.dataConf.add');
        }

    }

    public function update(){

        if (Input::method() == 'POST'){
            $data = Input::except('_token');
            $data['updatetime'] = date('Y-m-d H:i:s');
            DataConf::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() ->with('status','编辑成功！');
        }else{
            $data = DataConf::where('id',Input::get('id')) -> get();
            return view('admin.dataConf.update',compact('data'));
        }

    }
}
