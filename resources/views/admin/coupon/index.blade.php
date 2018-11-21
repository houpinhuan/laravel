@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 营销活动 <span class="c-gray en">&gt;</span> 优惠券 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;" placeholder="创建时间">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;" placeholder="创建时间">
        <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜优惠券</button>
    </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="coupon_add('添加优惠券','/admin/coupon/add','800','700')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加优惠券</a></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="14">优惠券</th>
        </tr>
        <tr class="text-c">
            <th>优惠券类型</th>
            <th>领取限制方式</th>
            <th>满足使用的金额</th>
            <th>抵扣金额或者折扣</th>
            <th>发放数量</th>
            <th>有效期开始</th>
            <th>有效期结束</th>
            <th>可使用时间开始</th>
            <th>可使用时间结束</th>
            <th>领取时间开始</th>
            <th>领取时间结束</th>
            <th class="td-status">状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>@if($value->type==1)满减@else折扣@endif</td>
                <td>@if($value->limited==0)数量
                    @elseif($value->limited==1)日
                    @elseif($value->limited==2)周
                    @elseif($value->limited==3)月
                    @else年@endif</td>
                <td>{{$value->amount}}</td>
                <td>{{$value->deduction}}</td>
                <td>{{$value->quantity}}</td>
                <td>{{$value->validstart}}</td>
                <td>{{$value->validend}}</td>
                <td>{{$value->usestart}}</td>
                <td>{{$value->useend}}</td>
                <td>{{$value->receivestart}}</td>
                <td>{{$value->receiveend}}</td>
                <td>@if($value->status==0)下架
                    @elseif($value->status==1)上架
                    @else删除@endif</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    @if($value->status==1)
                        <a style="text-decoration:none" onClick="coupon_stop(this,{{$value->id}})" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe631;</i></a>
                    @elseif($value->status==0)
                        <a style="text-decoration:none" onClick="coupon_start(this,{{$value->id}})" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe615;</i></a>
                        <a style="text-decoration:none" onClick="coupon_del(this,{{$value->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe60b;</i></a>
                    @endif
                    <a title="编辑" href="javascript:;" onclick="coupon_edit('优惠券编辑','/admin/coupon/update','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="查看日志" href="javascript:;" onclick="coupon_day('查看日志','/admin/coupon/day','600','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe623;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false,"aTargets":[ 13 ]}],
        "order": [12,'desc'],
    });

    /*优惠券-添加*/
    function coupon_add(title,url,w,h){
        layer_show(title,url,w,h);
    }

    /*优惠券-下架*/
    function coupon_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/coupon/status',
                type:'post',
                dataType:'json',
                data:{'status':0, 'id':id,},
                success:function(result){
                    if (result == '1') {
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="coupon_start(this,id)" href="javascript:;" title="上架" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('下架');
                        $(obj).remove();
                        layer.msg('已下架!',{icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('下架失败!',{icon: 5,time:1000});
                    }

                }
            });
        });
    }

    /*优惠券-上架*/
    function coupon_start(obj,id){
        layer.confirm('确认要上架吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/coupon/status',
                type:'post',
                dataType:'json',
                data:{'status':1, 'id':id,},
                success:function(result){
                    if (result == '1'){
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="coupon_stop(this,id)" href="javascript:;" title="下架" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('上架');
                        $(obj).remove();
                        layer.msg('已上架!', {icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('上架失败!', {icon: 5,time:1000});
                    }
                }
            });
        });
    }

    /*优惠券-删除*/
    function coupon_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/coupon/status',
                type:'post',
                dataType:'json',
                data:{'status':2, 'id':id,},
                success:function(result){
                    if (result == '1') {
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

    /*优惠券-编辑*/
    function coupon_edit(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*优惠券-查看日志*/
    function coupon_day(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection