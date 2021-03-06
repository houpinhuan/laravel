@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 系统管理 
    <span class="c-gray en">&gt;</span> 菜单列表
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>

<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <a href="javascript:;" onclick="menu_add('添加菜单', '/admin/system/menu/add', '500', '500')" class="btn btn-primary radius">
            <i class="Hui-iconfont">&#xe600;</i> 添加菜单
        </a>
    </div>

    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="7">菜单列表</th>
        </tr>
        <tr class="text-c">
            <th>编号</th>
            <th>菜单名称</th>
            <th>菜单级别</th>
            <th>链接</th>
            <th>样式</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->pid > 0 ? '2级' : '1级' }}</td>
                <td>{{ $value->action }}</td>
                <td>{{ $value->class }}</td>
                <td>{{ $value->datetime }}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="menu_edit('编辑菜单','/admin/system/menu/update','500','500','{{ $value->id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
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
    "aoColumnDefs": [ { "bSortable": false,"aTargets":[1, 2, 3, 4, 5, 6]}],
    "order": [0, 'asc'],
});

/*类目-添加*/
function menu_add(title,url,w,h){
    layer_show(title,url,w,h);
}

/*类目-编辑*/
function menu_edit(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

</script>
@endsection