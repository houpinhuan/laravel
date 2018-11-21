@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 代理管理 
    <span class="c-gray en">&gt;</span> 代理区域
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>

<div class="page-container">
    <form action="" method="get">
        @inject('role', 'App\Services\RoleService')
        <div class="text-c">
            <input class="input-text" style="width:120px;" name="agencyuserId" size="1" value="{{ $agencyuserId }}">
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜代理编号</button>
        </div>
    </form>

    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <a href="javascript:;" onclick="area_add('添加代理区域', '/admin/agency/area/add', '500', '500')" class="btn btn-primary radius">
            <i class="Hui-iconfont">&#xe600;</i> 添加代理区域
        </a>
    </div>

    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="8">代理区域列表</th>
        </tr>
        <tr class="text-c">
            <th>编号</th>
            <th>地址</th>
            <th>等级</th>
            <th>代理用户编号</th>
            <th>状态</th>
            <th>是否锁定</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{ $value->id }}</td>
                <td>{{ $value->area->name }}</td>
                <td>{{ $value->level == 1 ? '区县代理' : ($value->level == 2 ? '市代理' : '省代理') }}</td>
                <td>{{ $value->agencyuserId }}</td>
                <td>{{ $value->status == 1 ? '正常' : '禁用' }}</td>
                <td>{{ $value->lock == 1 ? '已锁定' : '' }}</td>
                <td>{{ $value->createtime }}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="area_edit('编辑代理区域','/admin/agency/area/update','500','500','{{ $value->id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
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
    "aoColumnDefs": [ { "bSortable": false,"aTargets":[1, 2, 4, 5, 6 , 7]}],
    "order": [0, 'asc'],
});

/*代理区域-添加*/
function area_add(title,url,w,h){
    layer_show(title,url,w,h);
}

/*代理区域-编辑*/
function area_edit(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

</script>
@endsection