@extends('admin.layouts.content')

@section('content')
<body>
<div style="margin-left: 10px">
<strong>邀请人</strong>
    <div style="margin: 10px 0px 10px 20px">
        @if($invite)用户昵称：{{$invite}}
        @else无@endif
    </div>
<strong>被邀请人</strong>
@if(!empty($count[0]))
<table style="width: 400px;height: 50px">
    <tr>
        <td>推荐1级用户数量：{{$count[0]['level1']}}</td>
        <td>推荐2级用户数量：{{$count[0]['level2']}}</td>
    </tr>
    <tr>
        <td>推荐美发师用户数量：{{$count[0]['levelS']}}</td>
        <td>推荐店铺用户数量：{{$count[0]['levelT']}}</td>
    </tr>
</table>
@endif
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>用户编号</th>
            <th>用户昵称</th>
            <th>手机号码</th>
            <th>角色</th>
            <th>邀请时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->user['id_no']}}</td>
                <td>{{$value->user['nickname']}}</td>
                <td>{{$value->user['mobile']}}</td>
                <td>@if($value->user['role'] == 1)用户
                @elseif($value->user['role'] == 2)美发师
                @else商户@endif</td>
                <td>{{$value->createtime}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    //实例化datatables插件
    $('.table').dataTable({
        "aoColumnDefs": [ { "bSortable": false }],
        "searching": true,
    });
</script>
@endsection