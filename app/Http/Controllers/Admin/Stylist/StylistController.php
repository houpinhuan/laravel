<?php

namespace App\Http\Controllers\Admin\Stylist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Main\Service\Service;
use App\Main\Stylist\Stylist;
use App\Main\Stylist\StylistAuth;
use App\Main\Stylist\StylistAttach;
use App\Main\Stylist\StylistMonthCount;
use App\Main\Stylist\StylistCoupon;
use App\Main\Stylist\StylistCouponDayCount;
use App\Main\Stylist\StylistTime;
use App\Main\Stylist\StylistCount;
use App\Main\Stylist\StylistSetting;
use App\Main\User\User;
use App\Main\User\UserAsset;
use App\Main\Service\ServiceOption;
use App\Main\Service\ServicePackage;
use App\Main\Service\ServicePackageContent;
use Illuminate\Support\Facades\DB;
use Input;
use phpDocumentor\Reflection\DocBlock;

class StylistController extends Controller
{
    //美发师列表
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
            $data = Stylist::where($where) -> get();
        }else{
            $data = Stylist::get();
        }
//        $data = Stylist::paginate(4);
//        $data = Stylist::
//                select(DB::raw('count(status) as c'),'status',DB::raw('sum(userId) as s'))
//                ->groupBy('status')
//                ->get();
//              pr($data);die;
//        $data = $data->toarray();
//                $data = Stylist::
//                select('user.*','stylist.*')
//                ->join('user','stylist.userId','=','user.id')
//                ->get();
//        pr($data);die;
        return view('admin.stylist.stylist.index',compact('data','datemin','datemax'));

    }

    //美发师审核
    public function auth(){

        $auth = StylistAuth::where('stylistId',Input::get('id')) -> get();
        $data = StylistAttach::where('stylistId',Input::get('id')) -> where('status',1) -> get() -> toarray();
        $attach = [];
        foreach ($data as $value){
            if ($value['type'] != 6){
                $type = $value['type'];
                $attach[$type] = $value['path'];
            }else{
                $intelligence[] = $value['path'];
            }

        }
        return view('admin.stylist.stylist.auth',compact('auth','attach','intelligence'));

    }

    //美发师编辑
    public function update(Request $request){

        $userId = Stylist::where('id',Input::get('id')) -> value('userId');
        if (!empty(Input::get('username'))){
            $this -> validate($request,[
                'username'=>"unique:mysql_main.user,username,{$userId}",
            ],[
                'username.unique'=>'美发师账号已存在',
            ]);
        }
        if (!empty(Input::get('mobile'))){
            $this -> validate($request,[
                'mobile'=>"bail|regex:/^1[34578][0-9]{9}$/|unique:mysql_main.user,mobile,{$userId}",
            ],[
                'mobile.regex'=>'美发师手机号格式不对',
                'mobile.unique'=>'美发师手机号已存在',
            ]);
        }
        if (Input::method() == 'POST'){
            $this -> validate($request, [
                'password_confirmation'=>"same:password",
                'position'=>"required"
            ],[
                'password_confirmation.same'=>'确认密码与美发师密码不一致',
                'position.required'=>'美发师职位是必填字段',
            ]);
            $data = [
                'username'=>Input::get('username'),
                'mobile'=>Input::get('mobile'),
                'selfIntroduction'=>Input::get('selfIntroduction'),
                'status'=>Input::get('status'),
            ];
            if (!empty(Input::get('password_confirmation'))){
                $data['password'] = md5(Input::get('password_confirmation'));
            }
            User::where('id',$userId) -> update($data);
            Stylist::where('id',Input::get('id')) -> update(['position'=>Input::get('position')]);
            return redirect() -> back() -> with('status','编辑成功');
        }else{
            $userId = Stylist::where('id',Input::get('id')) -> value('userId');
            $data = User::where('id',$userId) -> get();
            $position = Stylist::where('id',Input::get('id')) -> value('position');
            return view('admin.stylist.stylist.update',compact('data','position'));
        }

    }

    //美发师资产
    public function asset(){

        $userId = Stylist::where('id',Input::get('id')) -> value('userId');
        $data = UserAsset::where('userId',$userId) -> get();
        return view('admin.stylist.stylist.asset',compact('data'));

    }

    //美发师时间信息表
    public function time(){

        $data = StylistTime::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.time',compact('data'));

    }

    //美发师锁定时间
    public function locktime(){

        $data = StylistTime::where('id',Input::get('id')) -> value('locktime');
        return view('admin.stylist.stylist.locktime',compact('data'));

    }

    //美发师累计评价
    public function stylistCount(){

        $data = StylistCount::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.stylistCount',compact('data'));

    }

    //美发师服务量
    public function service(){

        $data = StylistMonthCount::where('stylistId',Input::get('id')) -> orderBy('month','asc') -> get();
        return view('admin.stylist.stylist.service',compact('data'));

    }

    //美发师-门店
    public function setting(){

        $data = StylistSetting::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.setting',compact('data'));

    }

    //服务
    public function serviceInfo(){

        $data = Service::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.serviceInfo',compact('data'));

    }

    //服务状态更改
    public function serviceStatus(){

        $res = Service::where('id',Input::get('id')) -> update(['status'=>Input::get('status')]);
        return $res ? '1' : '0';

    }

    //服务选项
    public function serviceOption(){

        $data = ServiceOption::where('serviceId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.serviceOption',compact('data'));

    }

    //优惠券
    public function coupon(){

        $data = StylistCoupon::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.coupon',compact('data'));

    }

    //优惠券-查看日志
    public function couponDay(){

        $data = StylistCouponDayCount::where('couponId',Input::get('id')) -> orderBy('day','asc') -> get();
        return view('admin.stylist.couponDay',compact('data'));

    }

    //套餐券
    public function package(){

        $data = ServicePackage::where('stylistId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.package',compact('data'));

    }

    //套餐券-内容查看
    public function packageContent(){

        $data = ServicePackageContent::with(['category'=>function($query){
        }]) -> where('packageId',Input::get('id')) -> get();
        return view('admin.stylist.stylist.packageContent',compact('data'));

    }


}
