<?php

namespace App\Http\Controllers\Admin\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Store\Store;
use App\Main\Store\StoreAuth;
use App\Main\Store\StoreAttach;
use App\Main\Store\StoreSetting;
use App\Main\Store\StoreLocation;
use App\Main\Store\StoreMonthCount;
use App\Main\Store\StoreNexus;
use App\Main\Store\StoreCategory;
use App\Main\Category\Category;
use App\Main\Store\StoreAuthApply;
use App\Main\User\User;
use App\Main\User\UserAsset;
use App\Main\Area\Area;
use App\Main\Store\StoreCount;
use Input;

class StoreController extends Controller
{
    //门店列表
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
            $data = Store::where($where) -> get();
        }else{
            $data = Store::get();
        }
        return view('admin.store.store.index',compact('data','datemin','datemax'));

    }

    //修改门店状态
    public function status(){

        $res = Store::where('id',Input::get('id')) -> update(['status' => Input::get('status')]);
        return $res ? '1' : '0';

    }

    //门店审核状态
    public function auth(){

        $data = Store::where('id',Input::get('id')) -> get();
        $auth = StoreAuth::where('storeId',Input::get('id')) -> get();
        $res = StoreAttach::where('storeId',Input::get('id')) -> where('status',1) -> get() -> toArray();
        $attach = [];
        foreach($res as $val){
            $type = $val['type'];
            $attach[$type] = $val['path'];
        }
        return view('admin.store.store.auth',compact('data','auth','attach'));

    }

    //商户资产
    public function asset(){

        $userId = Store::where('id',Input::get('id')) -> value('userId');
        $data = UserAsset::where('userId',$userId) -> get();
        return view('admin.store.store.asset',compact('data'));
    }

    //门店添加
    public function add(Request $request){

        if(Input::method() == 'POST'){
            if (!empty(Input::get('username'))){
                $this -> validate($request,[
                    'username'=>'unique:mysql_main.user,username',
                ],[
                    'username.unique'=>'商户账号已存在',
                ]);
            }
            if (!empty(Input::get('user_mobile'))){
                $this -> validate($request,[
                    'user_mobile'=>'bail|regex:/^1[34578][0-9]{9}$/|unique:mysql_main.user,mobile',
                ],[
                    'user_mobile.regex'=>'商户手机号格式不对',
                    'user_mobile.unique'=>'商户手机号已存在',
                ]);
            }
            $this -> validate($request,[
                'id_no'=>'bail|required|unique:mysql_main.user,id_no|max:10',
                'realname'=>'bail|required|min:2',
                'password_confirmation'=>"same:password",
//                'cardno'=>'bail|required|regex:/^[1-9]{1}[0-9]{14}$/|/^[1-9]{1}[0-9]{16}([0-9]|[xX])$/',
//                'licenseno'=>'bail|required|regex:/^\d{15}$/',
                'storename'=>'required',
                'contact'=>'bail|required|min:2',
                'mobile'=>'bail|required|regex:/^1[34578][0-9]{9}$/',
                'remark'=>'required',
                'attach1'=>'required',
                'attach2'=>'required',
            ],[
                'id_no.required'=>'商户编号是必填字段',
                'id_no.unique'=>'商户编号已存在',
                'id_no.max'=>'商户编号最多10个字符',
                'realname.required'=>'真实姓名是必填字段',
                'realname.min'=>'真实姓名最少2个字符',
                'password_confirmation.same'=>'确认密码与商户密码不一致',
                'cardno.required'=>'身份证号码是必填字段',
                'cardno.regex'=>'身份证号码格式不对',
                'storename.required'=>'门店名称是必填字段',
                'contact.required'=>'联系人是必填字段',
                'contact.min'=>'联系人最少2个字符',
                'mobile.required'=>'联系人手机号是必填字段',
                'mobile.regex'=>'联系人手机号格式不对',
                'remark.regex'=>'备注是必填字段',
                'attach1.required'=>'请上传营业执照',
                'attach2.required'=>'请上传拥有者手持身份照',
            ]);
            $user = [
                'id_no'=>Input::get('id_no'),
                'username'=>Input::get('username'),
                'nickname'=>Input::get('user_mobile'),
                'mobile'=>Input::get('user_mobile'),
                'gender'=>Input::get('gender'),
                'role'=>3,
                'status'=>Input::get('user_status'),
                'createtime'=>date('Y-m-d H:i:s'),
            ];
            if (!empty(Input::get('password_confirmation'))){
                $user['password'] = md5(Input::get('password_confirmation'));
            }
            $userId = User::insertGetId($user);
            $data = [
                'userId'=>$userId,
                'storename'=>Input::get('storename'),
                'contact'=>Input::get('contact'),
                'mobile'=>Input::get('mobile'),
                'status'=>Input::get('status'),
                'createtime'=>date('Y-m-d H:i:s'),
            ];
            $storeId = Store::insertGetId($data);
            $authApply = [
                'storeId'=>$storeId,
                'realname'=>Input::get('realname'),
                'cardno'=>Input::get('cardno'),
                'licenseno'=>Input::get('licenseno'),
                'status'=>0,
                'remark'=>Input::get('remark'),
                'createtime'=>date('Y-m-d H:i:s'),
            ];
            StoreAuthApply::insert($authApply);
            $attach = [
                [   'storeId'=>$storeId,
                    'type'=>2,
                    'path'=>Input::get('attach1'),
                    'status'=>1,
                    'createtime'=>date('Y-m-d H:i:s')],
                [   'storeId'=>$storeId,
                    'type'=>3,
                    'path'=>Input::get('attach2'),
                    'status'=>1,
                    'createtime'=>date('Y-m-d H:i:s')]
            ];
            StoreAttach::insert($attach);
            return redirect() -> back() -> with('status','添加成功！');
        }else{
            return view('admin.store.store.add',compact('data'));
        }

    }

    //门店编辑
    public function update(Request $request){

        $userId = Store::where('id',Input::get('id')) -> value('userId');
        if (Input::method() == 'POST'){
            if (!empty(Input::get('username'))){
                $this -> validate($request,[
                    'username'=>"unique:mysql_main.user,username,{$userId}",
                ],[
                    'username.unique'=>'商户账号已存在',
                ]);
            }
            if (!empty(Input::get('user_mobile'))){
                $this -> validate($request,[
                    'user_mobile'=>"bail|required|regex:/^1[34578][0-9]{9}$/|unique:mysql_main.user,mobile,{$userId}",
                ],[
                    'user_mobile.regex'=>'商户手机号格式不对',
                    'user_mobile.unique'=>'商户手机号已存在',
                ]);
            }
            $this -> validate($request,[
                'password_confirmation'=>"same:password",
                'storename'=>'required',
                'contact'=>'required',
                'mobile'=>'required',
            ],[
                'username.unique'=>'商户账号已存在',
                'password_confirmation.same'=>'确认密码与商户密码不一致',
                'storename.required'=>'门店名称是必填字段',
                'contact.required'=>'联系人是必填字段',
                'mobile.required'=>'联系人手机号是必填字段',
            ]);
            $user = [
                'username'=>Input::get('username'),
                'mobile'=>Input::get('user_mobile'),
                'gender'=>Input::get('gender'),
                'updatetime'=>date('Y-m-d H:i:s'),
            ];
            if (!empty(Input::get('password_confirmation'))){
                $user['password'] = md5(Input::get('password_confirmation'));
            }
            $data = [
                'storename'=>Input::get('storename'),
                'contact'=>Input::get('contact'),
                'mobile'=>Input::get('mobile'),
                'status'=>Input::get('status'),
                'updatetime'=>date('Y-m-d H:i:s'),
            ];
            User::where('id',$userId) -> update($user);
            Store::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() -> with('status','编辑成功！');
        }else{
            //门店信息
            $data = Store::where('id',Input::get('id')) -> get();
            //商户信息
            $userId = Store::where('id',Input::get('id')) -> value('userId');
            $user = User::where('id',$userId) -> get();
            return view('admin.store.store.update',compact('data','user'));
        }

    }

    //门店信息
    public function info(){

        //门店服务类目
        $categoryId = StoreCategory::where('storeId',Input::get('id')) -> select('categoryId') -> get() -> toArray();
        $category = Category::whereIn('id',$categoryId) -> select('name') -> get() -> toArray();
        //门店基本信息
        $data = StoreSetting::where('storeId',Input::get('id')) -> get();
        $str = "";
        $location = StoreLocation::where('storeId',Input::get('id')) -> select('provinceId','cityId','districtId') -> get();
        $str .= Area::where('id',$location[0]->provinceId) -> value('name');
        $str .= Area::where('id',$location[0]->cityId) -> value('name');
        $str .= Area::where('id',$location[0]->districtId) -> value('name');
        $res = StoreLocation::where('storeId',Input::get('id')) -> select('location','longitude','latitude') -> get() -> toArray();
        foreach ($res as $value){
            $str .= $value['location'];
            $str .= $value['longitude'];
            $str .= $value['latitude'];
        }
        //门店评分
        $count = StoreCount::where('storeId',Input::get('id')) -> get();
        return view('admin.store.store.info',compact('category','data','str','count'));

    }

    //门店入驻信息
    public function nexus0(){

        $data = StoreMonthCount::where('storeId',Input::get('id')) -> orderBy('month','asc') -> get();
        return view('admin.store.store.nexus0',compact('data'));

    }


    //门店签约信息
    public function nexus1(){

        $data = StoreMonthCount::where('storeId',Input::get('id')) -> orderBy('month','asc') -> get();
        return view('admin.store.store.nexus1',compact('data'));

    }

    //门店服务信息
    public function service(){

        $data = StoreMonthCount::where('storeId',Input::get('id')) -> orderBy('month','asc') -> get();
        return view('admin.store.store.service',compact('data'));

    }

    //门店美发师联系
    public function nexus(){

        $data = StoreNexus::where('storeId',Input::get('id')) -> get();
        return view('admin.store.store.nexus',compact('data'));

    }

}
