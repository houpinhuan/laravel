<?php

namespace App\Http\Controllers\Admin\Reward;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Reward\RewardSetting;
use Input;

class RewardController extends Controller
{
    //公共
    public function common($datemin,$datemax){

        if (!empty($datemin)){
            $where[] = ['createtime','>=',date('Y-m-d H:i:s',strtotime($datemin))];
        }
        if (!empty($datemax)){
            $where[] = ['createtime','<=',date('Y-m-d H:i:s',strtotime($datemax)+86400)];
        }
        if (!empty($where)){
            return $where;
        }
    }

    //注册奖励
    public function register(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['type','=','register'];
        $data = RewardSetting::where($where) -> get();
        return view('admin.reward.register',compact('data','datemin','datemax'));

    }

    //邀请奖励
    public function invite(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['type','=','invite'];
        $data = RewardSetting::where($where) -> get();
        return view('admin.reward.invite',compact('data','datemin','datemax'));

    }

    //消费奖励
    public function consume(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['type','=','consume'];
        $data = RewardSetting::where($where) -> get();
        return view('admin.reward.consume',compact('data','datemin','datemax'));

    }

    //被邀请奖励
    public function binvite(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['type','=','binvite'];
        $data = RewardSetting::where($where) -> get();
        return view('admin.reward.binvite',compact('data','datemin','datemax'));

    }
}
