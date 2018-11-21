<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\User\UserAssetLog;
use Input;

class UserAssetLogController extends Controller
{
    //资产列表
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
            $data = UserAssetLog::where($where) -> get();
        }else{
            $data = UserAssetLog::get();
        }
        return view('admin.user.userAssetLog.index',compact('data','datemin','datemax'));

    }
}
