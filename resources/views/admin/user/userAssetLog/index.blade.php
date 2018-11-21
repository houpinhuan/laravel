@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 资产列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form method="get" action="">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="13">资产列表</th>
        </tr>
        <tr class="text-c">
            <th>账号</th>
            <th>昵称</th>
            <th>手机号</th>
            <th>性别</th>
            <th>角色</th>
            <th>用户状态</th>
            <th>资产类型</th>
            <th>资产状态</th>
            <th>变更额度</th>
            <th>原有额度</th>
            <th>新的额度</th>
            <th>备注</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->user->username}}</td>
                <td>{{$value->user->nickname}}</td>
                <td>{{$value->user->mobile}}</td>
                <td>@if($value->user->gender==1)男
                    @elseif($value->user->gender==2)女
                    @else人妖 @endif</td>
                <td>@if($value->user->role==1)用户
                    @elseif($value->user->role==2)美发师
                    @else 商户@endif</td>
                <td>@if($value->user->status==0)正常
                    @else 禁止 @endif</td>
                <td>@if($value->type==1)余额@else虚拟余额@endif</td>
                <td>@if($value->status==1)增加@else减少@endif</td>
                <td>{{$value->changebalance}}</td>
                <td>{{$value->oldbalance}}</td>
                <td>{{$value->newbalance}}</td>
                <td>{{$value->remark}}</td>
                <td>{{$value->createtime}}</td>
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
        "aoColumnDefs": [ { "bSortable": false,}],
        "order":[12,'desc'],
    });
</script>
@endsection