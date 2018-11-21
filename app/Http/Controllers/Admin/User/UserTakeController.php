<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\User\UserTake;
use Input;
use Excel;

class UserTakeController extends Controller
{
    //已处理（已拒绝-已完成）
    public function handle(){

        if (!empty(Input::get('datemin'))){
            $datemin = Input::get('datemin');
            $where[] = ['createtime','>=',date('Y-m-d H:i:s',strtotime($datemin))];
        }
        if (!empty(Input::get('datemax'))){
            $datemax = Input::get('datemax');
            $where[] = ['createtime','<=',date('Y-m-d H:i:s',strtotime($datemax)+86400)];
        }
        if (!empty($where)){
            $data = UserTake::where($where) -> whereIn('status',[0,9]) -> get();
        }else{
            $data = UserTake::whereIn('status',[0,9]) -> get();
        }
        return view('admin.user.userTake.handle',compact('data','datemin','datemax'));

    }

    //处理中
    public function apply(){

        if (!empty(Input::get('datemin'))){
            $datemin = Input::get('datemin');
            $where[] = ['createtime','>=',date('Y-m-d H:i:s',strtotime($datemin))];
        }
        if (!empty(Input::get('datemax'))){
            $datemax = Input::get('datemax');
            $where[] = ['createtime','<=',date('Y-m-d H:i:s',strtotime($datemax)+86400)];
        }
        $where[] = ['status','=',1];
        $data = UserTake::where($where) -> get();
        return view('admin.user.userTake.apply',compact('data','datemin','datemax'));

    }

    //审核申请
    public function auth(){

        if (Input::method() == 'POST'){

            if (Input::get('status')!=null){
                UserTake::where('id',Input::get('id')) -> update(['status'=>Input::get('status'),'updatetime'=>date('Y-m-d H:i:s')]);
                return redirect() -> back() -> with('status','提交成功！');
            }
        }else{
            $data = UserTake::where('id',Input::get('id')) -> get();
            return view('admin.user.userTake.auth',compact('data'));
        }

    }

    //导出已完成数据
    public function finish(){

        //表头
        $cellData = [
            ['昵称','真实名称','手机号码','性别','角色','用户状态','证件号码','账号类型','账号','账户附加支行信息','金额','手续费','创建时间']
        ];
        //查询数据
        $data = UserTake::where('status',9) -> orderBy('updatetime','desc') -> get();
        foreach ($data as $value){
            if ($value -> user -> gender == 1){
                $gender = '男';
            }elseif($value -> user -> gender == 2){
                $gender = '女';
            }else{
                $gender = '人妖';
            }
            if ($value -> user -> role == 1){
                $role = '用户';
            }elseif($value -> user -> role == 2){
                $role = '美发师';
            }else{
                $role = '商户';
            }
            if ($value -> user -> status == 0){
                $userStatus = '正常';
            }else{
                $userStatus = '禁止';
            }
            $cellData[] = [$value -> user -> nickname, $value -> realname, $value -> user -> mobile, $gender, $role, $userStatus, $value -> idcard, $value -> accounttype, $value -> accountno, $value -> accountbranch, $value -> amount, $value -> fee, $value -> updatetime];
        }
        Excel::create(sha1(time().rand(1000,9999)),function ($excel) use ($cellData){
           $excel -> sheet('已完成的提现信息',function ($sheet) use ($cellData){
               $sheet -> rows($cellData);
           });
        }) -> export('xls');

    }

    //导出申请中数据
    public function export(){

        //表头
        $cellData = [
            ['昵称','真实名称','手机号码','性别','角色','用户状态','证件号码','账号类型','账号','账户附加支行信息','金额','手续费','创建时间']
        ];
        //查询数据
        $data = UserTake::where('status',1) -> orderBy('createtime','desc') -> get();
        foreach ($data as $value){
            if ($value -> user -> gender == 1){
                $gender = '男';
            }elseif($value -> user -> gender == 2){
                $gender = '女';
            }else{
                $gender = '人妖';
            }
            if ($value -> user -> role == 1){
                $role = '用户';
            }elseif($value -> user -> role == 2){
                $role = '美发师';
            }else{
                $role = '商户';
            }
            if ($value -> user -> status == 0){
                $userStatus = '正常';
            }else{
                $userStatus = '禁止';
            }
            $cellData[] = [$value -> user -> nickname, $value -> realname, $value -> user -> mobile, $gender, $role, $userStatus, $value -> idcard, $value -> accounttype, $value -> accountno, $value -> accountbranch, $value -> amount, $value -> fee, $value -> createtime];
        }
        Excel::create(sha1(time().rand(1000,9999)),function ($excel) use ($cellData){
           $excel -> sheet('申请中的提现信息',function ($sheet) use ($cellData){
               $sheet -> rows($cellData);
           });
        }) -> export('xls');

    }
}
