@extends('admin.layouts.content')

@section('content')
<div style="margin-left: 10px">
    <div class="page-container">
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr class="text-c">
                <th>美发师编号</th>
                <th>美发师昵称</th>
                <th>美发师手机号</th>
                <th>美发师性别</th>
                <th>美发师职位</th>
                <th>美发师状态</th>
                <th>关系</th>
                <th>入驻/签约时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="text-c">
                    <td>{{$value->user[0]['id_no']}}</td>
                    <td>{{$value->user[0]['nickname']}}</td>
                    <td>{{$value->user[0]['mobile']}}</td>
                    <td>@if($value->user[0]['gender'] ==1)男
                        @elseif($value->user[0]['gender'] ==2)女
                        @else 人妖
                        @endif</td>
                    <td>{{$value->stylist[0]['position']}}</td>
                    <td>@if($value->user[0]['status'] == 0)正常
                        @else禁止@endif</td>
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
        "order":[7,'desc'],
        "searching": true,
    });
</script>
@endsection