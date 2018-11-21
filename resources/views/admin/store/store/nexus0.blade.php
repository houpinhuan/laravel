@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="2">入驻列表</th>
        </tr>
        <tr class="text-c">
            <th>入驻月份</th>
            <th>入驻量</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->month}}</td>
                <td>{{$value->nexus0}}</td>
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
        "aoColumnDefs": [ { "bSortable": false }],
        "searching": true,
        'ordering':false,
    });

</script>
@endsection