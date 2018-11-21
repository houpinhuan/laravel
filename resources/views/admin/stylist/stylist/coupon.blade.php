@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>优惠券类型</th>
            <th>领取限制方式</th>
            <th>满足使用的金额</th>
            <th>抵扣金额或者折扣</th>
            <th>发放数量</th>
            <th>有效期开始</th>
            <th>有效期结束</th>
            <th>可使用时间开始</th>
            <th>可使用时间结束</th>
            <th>领取时间开始</th>
            <th>领取时间结束</th>
            <th>优惠券状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>@if($value->type==1)满减
                @else 折扣 @endif</td>
                <td>@if($value->limited==0)数量
                @elseif($value->limited==1)日
                @elseif($value->limited==2)周
                @elseif($value->limited==3)月
                @else 年 @endif</td>
                <td>{{$value->amount}}</td>
                <td>{{$value->deduction}}</td>
                <td>{{$value->quantity}}</td>
                <td>{{$value->validstart}}</td>
                <td>{{$value->validend}}</td>
                <td>{{$value->usestart}}</td>
                <td>{{$value->useend}}</td>
                <td>{{$value->receivestart}}</td>
                <td>{{$value->receiveend}}</td>
                <td>@if($value->status==1)上架
                    @elseif($value->status==0)下架
                    @else删除@endif</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="查看日志" href="javascript:;" onclick="coupon_day('查看日志','/admin/stylist/stylist/couponDay','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe623;</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

    //实例化datatables插件
    $('table').dataTable({
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 13 ] }],
    });

    /*优惠券—查看日志*/
    function coupon_day(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

</script>
@endsection