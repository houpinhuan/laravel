@extends('admin.layouts.content')

@section('content')
<div style="margin-left: 10px">
    <div class="page-container">
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr class="text-c">
                <th>门店名称</th>
                <th>门店联系人</th>
                <th>联系人手机号</th>
                <th>门店状态</th>
                <th>关系</th>
                <th>入驻/签约时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="text-c">
                    <td>{{$value->store[0]['storename']}}</td>
                    <td>{{$value->store[0]['contact']}}</td>
                    <td>{{$value->store[0]['mobile']}}</td>
                    <td>@if($value->store[0]['status'] ==1)正常
                        @else 关闭
                        @endif</td>
                    <td>@if($value->nexus == 0)入驻
                        @else签约@endif</td>
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
    $('table').dataTable({
        "aoColumnDefs": [ { "bSortable": false }],
        "order":[5,"desc"],
        "searching": true,
    });
</script>
@endsection