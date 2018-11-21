@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 反馈投诉 <span class="c-gray en">&gt;</span> 投诉列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜反馈</button>
        </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="13">投诉列表</th>
        </tr>
        <tr class="text-c">
            <th>订单编号</th>
            <th>服务方式</th>
            <th>用户昵称</th>
            <th>用户手机号</th>
            <th>用户状态</th>
            <th>美发师昵称</th>
            <th>美发师手机号</th>
            <th>美发师状态</th>
            <th>订单金额</th>
            <th>订单实付金额</th>
            <th>投诉状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->order->orderno}}</td>
                <td>@if($value->order->servicemodel==1)普通服务@else套餐服务@endif</td>
                <td>{{$value->user->nickname}}</td>
                <td>{{$value->user->mobile}}</td>
                <td>@if($value->user->status==0)正常@else禁止@endif</td>
                <td>{{$value->user_stylist[0]->nickname}}</td>
                <td>{{$value->user_stylist[0]->mobile}}</td>
                <td>@if($value->user_stylist[0]->status==0)正常@else禁止@endif</td>
                <td>{{$value->order->orderamount}}</td>
                <td>{{$value->order->payamount}}</td>
                <td>@if($value->status==1)正常@else删除@endif</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="详情" href="javascript:;" onclick="complaint('详情','/admin/order/complaintOrder/complaint','600','300','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6f9;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false,"aTargets":[ 12 ]}],
        "order":[11,'desc'],
    });

    /*投诉-内容*/
    function complaint(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection