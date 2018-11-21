@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 发类管理 <span class="c-gray en">&gt;</span> 发类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜发类</button>
    </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="hairstyle_add('添加发类','/admin/hairstyle/add','800','350')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加发类</a></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="4">发类列表</th>
        </tr>
        <tr class="text-c">
            <th>发类名称</th>
            <th>发类描述</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->name}}</td>
                <td>{{$value->describe}}</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="hairstyle_edit('编辑','/admin/hairstyle/update','800','350','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false,"aTargets":[ 3 ] }],
        "order": [2,'desc'],
    });

    /*发类-添加*/
    function hairstyle_add(title,url,w,h){
        layer_show(title,url,w,h);
    }

    /*发类-编辑*/
    function hairstyle_edit(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection