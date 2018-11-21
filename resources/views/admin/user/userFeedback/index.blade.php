@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 反馈投诉 <span class="c-gray en">&gt;</span> 反馈列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
            <th scope="col" colspan="8">反馈列表</th>
        </tr>
        <tr class="text-c">
            <th>账号</th>
            <th>昵称</th>
            <th>手机号码</th>
            <th>性别</th>
            <th>角色</th>
            <th>状态</th>
            <th>反馈内容</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->user[0]->username}}</td>
                <td>{{$value->user[0]->nickname}}</td>
                <td>{{$value->user[0]->mobile}}</td>
                <td>@if($value->user[0]->gender==1)男
                    @elseif($value->user[0]->gender==2)女
                    @else人妖 @endif</td>
                <td>@if($value->user[0]->role==1)用户
                    @elseif($value->user[0]->role==2)美发师
                    @else 商户@endif</td>
                <td>@if($value->user[0]->status==0)正常
                @else 禁止 @endif</td>
                <td>{{$value->feedback}}</td>
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
        "order":[7,'desc'],
    });

</script>
@endsection