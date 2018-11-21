@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>服务名称</th>
            <th>服务类目</th>
            <th>所需时间（单位：分钟）</th>
            <th>单价</th>
            <th>是否包含可选项</th>
            <th>是否上架</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->servicename}}</td>
                <td>{{$value->category['name']}}</td>
                <td>{{$value->duration}}</td>
                <td>{{$value->price}}</td>
                <td>@if($value->isoption==1)有@else无@endif</td>
                <td>@if($value->online==1)上架@else下架@endif</td>
                <td class="td-status">@if($value->status==1)正常@else删除@endif</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    @if($value->status==1)
                        <a style="text-decoration:none" onClick="service_stop(this,{{$value->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe631;</i></a>
                    @else
                        <a style="text-decoration:none" onClick="service_start(this,{{$value->id}})" href="javascript:;" title="正常"><i class="Hui-iconfont">&#xe615;</i></a>
                    @endif
                    <a title="服务选项" href="javascript:;" onclick="service_option('服务选项','/admin/stylist/stylist/serviceOption','1000','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6f9;</i></a>
                </td>
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
        "aoColumnDefs": [ { "bSortable": false,"aTargets":[ 8 ] }],
        "order": [7,'desc'],
    });

    /*服务-删除*/
    function service_stop(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/stylist/stylist/serviceStatus',
                type:'post',
                dataType:'json',
                data:{'status':0, 'id':id,},
                success:function(result){
                    if (result == '1') {
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="service_start(this,id)" href="javascript:;" title="正常" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('删除');
                        $(obj).remove();
                        layer.msg('已删除!',{icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('删除失败!',{icon: 5,time:1000});
                    }

                }
            });
        });
    }
    /*服务-正常*/
    function service_start(obj,id){
        layer.confirm('确认要正常吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/stylist/stylist/serviceStatus',
                type:'post',
                dataType:'json',
                data:{'status':1, 'id':id,},
                success:function(result){
                    if (result == '1'){
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="service_stop(this,id)" href="javascript:;" title="删除" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('正常');
                        $(obj).remove();
                        layer.msg('已正常!', {icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('正常失败!', {icon: 5,time:1000});
                    }
                }
            });
        });
    }

    /*服务-选项*/
    function service_option(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection