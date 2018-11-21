@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 代理管理 
    <span class="c-gray en">&gt;</span> 代理用户
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>

<div class="page-container">
    <form method="get" action="">
        <div class="text-c">
            <input type="text" class="input-text" name="idNo" value="@if(!empty($idNo)){{$idNo}}@endif" style="width:120px;">
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜代理编号</button>
        </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="7">代理用户列表</th>
        </tr>
        <tr class="text-c">
            <th>编号</th>
            <th>昵称</th>
            <th>手机号码</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{ $value->id }}</td>
                <td>{{ $value->nickname }}</td>
                <td>{{ $value->mobile }}</td>
                <td>{{ $value->createtime }}</td>
                <td class="td-manage">
                    <a title="重置" href="javascript:;" onclick="user_reset('重置代理用户密码', '/admin/agency/user/reset','400','300','{{ $value->id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="提现绑定信息" href="javascript:;" onclick="user_accountBind('提现绑定信息','/admin/agency/user/accountBind','1000','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6bf;</i></a>
                    <a title="资产" href="javascript:;" onclick="user_asset('资产','/admin/agency/user/asset','300','250','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe63a;</i></a>
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
    "aoColumnDefs": [ { "bSortable": false,"aTargets":[1, 2, 3, 4]}],
    "order": [0, 'desc'],
});

/*重置*/
function user_reset(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

/*提现绑定信息*/
function user_accountBind(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

/*资产*/
function user_asset(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

</script>
@endsection