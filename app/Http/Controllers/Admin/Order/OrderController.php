<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Main\Order\Order;
use App\Main\Order\OrderPay;
use App\Main\Order\OrderRefund;
use App\Main\Order\OrderAddMoney;
use App\Main\Order\OrderPackageContent;
use App\Main\Service\ServicePackage;
use App\Main\Store\StoreReviews;
use App\Main\Store\StoreReviewsAttach;
use App\Main\Stylist\StylistReviews;
use App\Main\Stylist\StylistReviewsAttach;
use Input;

class OrderController extends Controller
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

    //待处理
    public function one(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        if (!empty($where)){
            $data = Order::where($where) -> whereIn('status',[3,8,14]) -> get();
        }else{
            $data = Order::whereIn('status',[3,8,14]) -> get();
        }
        return view('admin.order.order.one',compact('data','datemin','datemax'));

    }

    //待完成
    public function two(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        if (!empty($where)){
            $data = Order::where($where) -> whereIn('status',[4,6,7,9,10]) -> get();
        }else{
            $data = Order::whereIn('status',[4,6,7,9,10]) -> get();
        }
        return view('admin.order.order.two',compact('data','datemax','datemin'));

    }

    //已完成
    public function three(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['status','=',11];
        $data = Order::where($where) -> get();
        return view('admin.order.order.three',compact('data','datemax','datemin'));

    }

    //退款
    public function four(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        if (!empty($where)){
            $data = Order::where($where) -> whereIn('status',[5,12,13,15,16,17]) -> get();
        }else{
            $data = Order::whereIn('status',[5,12,13,15,16,17]) -> get();
        }
        return view('admin.order.order.four',compact('data','datemin','datemax'));

    }

    //已评价
    public function five(){

        $datemin = Input::get('datemin');
        $datemax = Input::get('datemax');
        $where = $this -> common($datemin,$datemax);
        $where[] = ['status','=',18];
        $data = Order::where($where) -> get();
        return view('admin.order.order.five',compact('data','datemin','datemax'));

    }

    //支付详情
    public function pay(){

        $data = OrderPay::where('orderId',Input::get('id')) -> get();
        if (Input::get('status')==9){
            $addMoney = OrderAddMoney::where('orderId',Input::get('id')) -> where('status',2) -> value('addmoney');
        }
        if ($data[0]->paytype == 'package'){
            $res = OrderPackageContent::where('orderId',Input::get('id')) -> get() -> toArray();
            if ($res){
                $packageId = $res[0]['packageId'];
                $package = ServicePackage::where('id',$packageId) -> select('costprice','price') -> get();
            }
        }
        return view('admin.order.order.pay',compact('data','addMoney','res','package'));

    }

    //退单详情
    public function refund(){

        $data = OrderRefund::where('orderId',Input::get('id')) -> get();
        if (Input::get('status') != 12){
            $canceltime = Order::where('id',Input::get('id')) -> value('canceltime');
        }else{
            $handlingfee = Order::where('id',Input::get('id')) -> value('handlingfee');
        }
        if (Input::get('status') == 16||Input::get('status') == 17){
            $refundtime = Order::where('id',Input::get('id')) -> value('refundtime');
        }
        return view('admin.order.order.refund',compact('data','canceltime','handlingfee','refundtime'));

    }

    //加价详情
    public function addMoney(){

        $data = OrderAddMoney::where('orderId',Input::get('id')) -> where('status',Input::get('status')) -> get();
        return view('admin.order.order.addMoney',compact('data'));

    }

    //订单-门店评论
    public function storeReviews(){

        $data = StoreReviews::where('orderId',Input::get('id')) -> get();
        $reviewsId = $data[0] -> id;
        $attach = StoreReviewsAttach::where('reviewsId',$reviewsId) -> where('status',1) -> get();
        return view('admin.order.order.storeReviews',compact('data','attach'));

    }

    //订单-美发师评论
    public function stylistReviews(){

        $data = StylistReviews::where('orderId',Input::get('id')) -> get();
        $reviewsId = $data[0] -> id;
        $attach = StylistReviewsAttach::where('reviewsId',$reviewsId) -> where('status',1) -> get();
        return view('admin.order.order.stylistReviews',compact('data','attach'));

    }
}
