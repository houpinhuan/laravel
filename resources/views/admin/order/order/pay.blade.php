@extends('admin.layouts.content')

@section('content')
<article class="page-container">
    <table style="margin-top: 10px;height: 300px">
        <tr>
            <td>支付订单号:</td>
            <td>{{$data[0]->payno}}</td>
        </tr>
        <tr>
            <td width="110px">支付平台单号:</td>
            <td>{{$data[0]->tradeNo}}</td>
        </tr>
        <tr>
            <td>支付方式:</td>
            <td>@if($data[0]->paytype=='alipay')支付宝
                @elseif($data[0]->paytype=='weixin')微信
                @elseif($data[0]->paytype=='package')套餐券
                @elseif($data[0]->paytype=='blance')余额
                @else 虚拟余额
                @endif</td>
        </tr>
        @if(!empty($addMoney))
        <tr>
            <td>加价金额:</td>
            <td>{{$addMoney}}</td>
        </tr>
        @endif
        <tr>
            <td>支付金额:</td>
            <td>{{$data[0]->payamount}}</td>
        </tr>
        @if(!empty($data[0]->couponId))
            <tr>
                <td>优惠券所属方:</td>
                <td>@if($data[0]->coupondirection==1)平台@else美发师@endif</td>
            </tr>
            <tr>
                <td>优惠券类型:</td>
                <td>@if($data[0]->coupontype==1)满减@else折扣@endif</td>
            </tr>
        @endif
        @if(!empty($res))
            <tr>
                <td>选项标题:</td>
                <td>{{$res[0]['optiontitle']}}</td>
            </tr>
            <tr>
                <td>选项名称:</td>
                <td>{{$res[0]['optionname']}}</td>
            </tr>
            <tr>
                <td>选项设值:</td>
                <td>{{$res[0]['optionvalue']}}</td>
            </tr>
            <tr>
                <td>套餐原价:</td>
                <td>{{$package[0]['costprice']}}</td>
            </tr>
            <tr>
                <td>套餐价格:</td>
                <td>{{$package[0]['price']}}</td>
            </tr>
        @endif
        <tr>
            <td>优惠金额:</td>
            <td>{{$data[0]->couponamount}}</td>
        </tr>
        <tr>
            <td>创建时间:</td>
            <td>{{$data[0]->createtime}}</td>
        </tr>
    </table>
</article>
@endsection
