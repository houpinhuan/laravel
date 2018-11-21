@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>日期</th>
            <th>工作时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->day}}</td>
                <td>{{$value->worktime}}</td>
                <td><a title="锁定时间" href="javascript:;" onclick="stylist_locktime('锁定时间','/admin/stylist/stylist/locktime','500','200','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6f9;</i></a></td>
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
        "order": [0,'desc'],
    });

    /*美发师-锁定时间*/
    function stylist_locktime(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection