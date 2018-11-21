@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>类目选项标题</th>
            <th>类目选项名称</th>
            <th>类目选项按钮</th>
            <th>选项标题</th>
            <th>选项名称</th>
            <th>选项设值</th>
            <th>价格</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->categoryOption->optiontitle}}</td>
                <td>{{$value->categoryOption->optionname}}</td>
                <td>{{$value->categoryOption->optionbutton}}</td>
                <td>{{$value->optiontitle}}</td>
                <td>{{$value->optionname}}</td>
                <td>{{$value->optionvalue}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->createtime}}</td>
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
        "aoColumnDefs": [ { "bSortable": false, }],
    });

</script>
@endsection