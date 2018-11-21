@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 已完成<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
    </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="15">已完成列表</th>
        </tr>
        <tr class="text-c">
            <th>订单编号</th>
            <th>订单名称</th>
            <th>用户昵称</th>
            <th>用户手机号</th>
            <th>用户性别</th>
            <th>美发师昵称</th>
            <th>门店名称</th>
            <th>门店联系人</th>
            <th>联系人手机号</th>
            <th>服务方式</th>
            <th>服务单价</th>
            <th>订单金额</th>
            <th>订单实付金额</th>
            <th>完成时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->orderno}}</td>
                <td>{{$value->ordername}}</td>
                <td>{{$value->user->nickname}}</td>
                <td>{{$value->user->mobile}}</td>
                <td>@if($value->user->gender==1)男
                    @elseif($value->user->gender==2)女
                    @else 人妖 @endif</td>
                <td>{{$value->stylist[0]['nickname']}}</td>
                <td>{{$value->store->storename}}</td>
                <td>{{$value->store->contact}}</td>
                <td>{{$value->store->mobile}}</td>
                <td>@if($value->servicemodel==1)普通服务
                    @else
                        @if($value->servicePackage['type']==1)单项多次套餐
                        @else 多项单次套餐
                        @endif
                    @endif</td>
                <td>{{$value->service->price}}</td>
                <td>{{$value->orderamount}}</td>
                <td>{{$value->payamount}}</td>
                <td>{{$value->endtime}}</td>
                <td>
                    <a title="支付详情" href="javascript:;" onclick="order_pay('支付详情','/admin/order/order/pay','300','400','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6b7;</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    //实例化datatables插件
    $('table').dataTable({
        "aoColumnDefs": [ { "bSortable": false ,"aTargets":[ 14 ]}],
        "order": [13,'desc'],
    });

    /*订单-支付*/
    function order_pay(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

</script>
@endsection