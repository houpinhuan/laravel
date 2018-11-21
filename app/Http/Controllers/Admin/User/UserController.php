<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\User\User;
use App\Main\User\UserAuth;
use App\Main\User\UserAttach;
use App\Main\User\UserLocation;
use App\Main\Area\Area;
use App\Main\User\UserAsset;
use App\Main\User\UserCode;
use App\Main\User\UserAccountBind;
use App\Main\User\UserPackage;
use App\Main\User\UserInvite;
use App\Main\User\UserInviteCount;
use Input;

class UserController extends Controller
{
    //用户列表
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
            $data = User::with(['userAttach' => function ($query){
                $query -> where('user_attach.type','1') -> where('user_attach.status',1);
            }]) -> where($where) -> get();
        }else{
            $data = User::with(['userAttach' => function ($query){
                $query -> where('user_attach.type','1') -> where('user_attach.status',1);
            }]) -> get();
        }
        return view('admin.user.user.index',compact('data','datemin','datemax'));

    }

    //用户审核情况
    public function auth(){

        $data = UserAuth::where('userId',Input::get('id')) -> get();
        $res = UserAttach::where('userId',Input::get('id')) -> where('status',1) -> get();
        $attach = [];
        foreach ($res as $val){
            $type = $val['type'];
            $attach[$type] = $val['path'];
        }
        return view('admin.user.user.auth',compact('data','attach'));

    }

    //修改用户状态
    public function status(){

        $res = User::where('id',Input::get('id')) -> update(['status' => Input::get('status')]);
        return $res ? '1' : '0';

    }

    //编辑用户
    public function update(Request $request){

        $id = Input::get('id');
        if (Input::method()== 'POST'){
            if (!empty(Input::get('username'))){
                $this -> validate($request,[
                    'username'=>"unique:mysql_main.user,username,{$id}",
                ],[
                    'username.unique'=>'用户账号已存在',
                ]);
            }
            if (!empty(Input::get('mobile'))){
                $this -> validate($request,[
                    'mobile'=>"bail|regex:/^1[34578][0-9]{9}$/|unique:mysql_main.user,mobile,{$id}",
                ],[
                    'mobile.regex'=>'手机号码格式不对',
                    'mobile.unique'=>'手机号码已存在',
                ]);
            }
            $this -> validate($request, [
                'nickname'=>"required",
                'password_confirmation'=>"same:password",
            ],[
                'nickname.required'=>'用户昵称是必填字段',
                'password_confirmation.same'=>'确认密码与用户密码不一致',
            ]);

            $data = [
                'username'=>Input::get('username'),
                'nickname'=>Input::get('nickname'),
                'mobile'=>Input::get('mobile'),
                'role'=>Input::get('role'),
                'status'=>Input::get('status'),
                'updatetime'=>date('Y-m-d H:i:s'),
            ];
            if (Input::get('password_confirmation') != ""){
                $data['password'] = md5(Input::get('password_confirmation'));
            }
            User::where('id',$id) -> update($data);
            if (Input::get('attach3')){
                $path = UserAttach::where('userId',Input::get('id')) -> where('type',1) -> where('status',1) -> value('path');
                if ($path){
                    UserAttach::where('userId',Input::get('id')) -> where('type',1) -> where('status',1) -> update(['path'=>Input::get('attach3')]);
                }else{
                    UserAttach::insert(['userId'=>Input::get('id'),'type'=>1,'path'=>Input::get('attach3'),'status'=>1,'createtime'=>date('Y-m-d H:i:s')]);
                }
            }
            return redirect() -> back() -> with('status','编辑成功！');
        }else{
            $data = User::where('id',$id) -> get();
            $path = UserAttach::where('userId',Input::get('id')) -> where('type',1) -> where('status',1) -> value('path');
            return view('admin.user.user.update',compact('data','path'));
        }
    }

    //用户信息
    public function info(){

        //背景图
        $banner = UserAttach::where('userId',Input::get('id')) -> where('type',2) -> where('status',1) ->value('path');
        //基本信息
        $user = User::where('id',Input::get('id')) -> select('role','birthday','hobby','job','hairstyle','faceture','selfIntroduction') -> get();
        $str = "";
        $location = UserLocation::where('userId',Input::get('id')) -> select('provinceId','cityId','districtId') -> get();
        $str .= Area::where('id',$location[0]->provinceId) -> value('name');
        $str .= Area::where('id',$location[0]->cityId) -> value('name');
        $str .= Area::where('id',$location[0]->districtId) -> value('name');
        $data = UserLocation::where('userId',Input::get('id')) -> select('location','longitude','latitude') -> get() -> toArray();
        foreach ($data as $value){
            $str .= $value['location'];
            $str .= $value['longitude'];
            $str .= $value['latitude'];
        }
        //资产
        $asset = UserAsset::where('userId',Input::get('id')) -> get();
        //邀请码
        $code = UserCode::where('userId',Input::get('id')) -> value('invitecode');
        return view('admin.user.user.info',compact('banner','user','str','asset','code'));

    }

    //用户提现绑定信息
    public function accountBind(){

        $data = UserAccountBind::where('userId',Input::get('id')) -> get();
        return view('admin.user.user.accountBind',compact('data'));

    }

    //用户套餐购买详情
    public function package(){

        $data = UserPackage::where('userId',Input::get('id')) -> get();
        return view('admin.user.user.package',compact('data'));

    }

    //邀请详情
    public function invite(){

        //邀请人
        $UserId = UserInvite::where('inviteUserId',Input::get('id')) -> value('UserId');
        $invite = User::where('id',$UserId) -> value('nickname');
        //推荐数量
        $count = UserInviteCount::where('userId',Input::get('id')) -> get();
        //被邀请人
        $data = UserInvite::where('userId',Input::get('id')) -> get();
        return view('admin.user.user.invite',compact('invite','count','data'));

    }


}
