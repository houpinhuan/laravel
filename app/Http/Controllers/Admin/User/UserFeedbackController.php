<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\User\UserFeedback;
use Input;

class UserFeedbackController extends Controller
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
            $data = UserFeedback::where($where) -> get();
        }else{
            $data = UserFeedback::get();
        }
        return view('admin.user.userFeedback.index',compact('data','datemin','datemax'));

    }
}
