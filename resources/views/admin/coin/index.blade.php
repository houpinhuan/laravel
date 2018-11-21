@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 代币管理 <span class="c-gray en">&gt;</span> 代币列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="5">代币列表</th>
        </tr>
        <tr class="text-c">
            <th>名称</th>
            <th>币的精度</th>
            <th>币的单位</th>
            <th>最小转账数量</th>
            <th>手续费</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->name}}</td>
                <td>{{$value->scale}}</td>
                <td>{{$value->unit}}</td>
                <td>{{$value->tradeamount}}</td>
                <td>{{$value->fee}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    //实例化datatables插件
    $('table').dataTable({
        "aoColumnDefs": [ { "bSortable": false}],
    });


</script>
@endsection