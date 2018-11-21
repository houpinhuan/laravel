<?php

namespace App\Http\Controllers\Admin\Coupon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Coupon\Coupon;
use App\Main\Coupon\CouponDayCount;
use Input;

class CouponController extends Controller
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
            $data = Coupon::where($where) -> get();
        }else{
            $data = Coupon::get();
        }
        return view('admin.coupon.index',compact('data','datemin','datemax'));

    }

    public function add(){

        if (Input::method() == 'POST'){
            $data = Input::except('_token');
            $data['createtime'] = date('Y-m-d H:i:s');
            Coupon::insert($data);
            return redirect() -> back() ->with('status','添加成功！');
        }else{
            return view('admin.coupon.add',compact('data'));
        }

    }

    public function update(){

        if (Input::method() == 'POST'){
            $data = Input::except('_token');
            $data['updatetime'] = date('Y-m-d H:i:s');
            Coupon::where('id',Input::get('id')) -> update($data);
            return redirect() -> back() ->with('status','编辑成功！');
        }else{
            $data = Coupon::where('id',Input::get('id')) -> get();
            return view('admin.coupon.update',compact('data'));
        }

    }

    //上架/下架/删除
    public function status(){

        $res = Coupon::where('id',Input::get('id')) -> update(['status'=>Input::get('status'),'updatetime'=>date('Y-m-d H:i:s')]);
        return $res ? '1' : '0';

    }

    //查看日志-优惠券每日详情
    public function day(){

        $data = CouponDayCount::where('couponId',Input::get('id')) -> get();
        return view('admin.coupon.day',compact('data'));

    }
}
