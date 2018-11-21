@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 类目管理 <span class="c-gray en">&gt;</span> 类目列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜类目</button>
    </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="category_add('添加类目','/admin/category/add','500','400')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加类目</a></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="5">类目列表</th>
        </tr>
        <tr class="text-c">
            <th>类目名称</th>
            <th>套餐1是否可选</th>
            <th>套餐2是否可选</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->name}}</td>
                <td>@if($value->package1==0)否@else是@endif</td>
                <td>@if($value->package2==0)否@else是@endif</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="category_edit('编辑','/admin/category/update','500','400','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="选项" href="javascript:;" onclick="category_option('选项','/admin/category/option','700','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6f9;</i></a>
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
    "aoColumnDefs": [ { "bSortable": false,"aTargets":[ 4 ]}],
    "order": [3,'desc'],
});

/*类目-添加*/
function category_add(title,url,w,h){
    layer_show(title,url,w,h);
}

/*类目-编辑*/
function category_edit(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}

/*类目-选项*/
function category_option(title,url,w,h,id){
    layer_show(title,url+'?id='+id,w,h);
}


</script>
@endsection