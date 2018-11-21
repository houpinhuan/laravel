@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 门店管理 <span class="c-gray en">&gt;</span> 门店列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif"class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜门店</button>
    </div>
    </form>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="store_add('添加门店','/admin/store/store/add','800','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加门店</a></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="14">门店列表</th>
        </tr>
        <tr class="text-c">
            <th>商户编号</th>
            <th>商户账号</th>
            <th>商户昵称</th>
            <th>手机号码</th>
            <th>性别</th>
            <th>门店名称</th>
            <th>联系人</th>
            <th>联系人手机号码</th>
            <th>门店状态</th>
            <th>入驻量</th>
            <th>签约量</th>
            <th>服务量</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->user->id_no}}</td>
                <td>{{$value->user->username}}</td>
                <td>{{$value->user->nickname}}</td>
                <td>{{$value->user->mobile}}</td>
                <td>
                    @if($value->user->gender == 1)男
                    @elseif($value->user->gender == 2)女
                    @else 人妖
                    @endif
                </td>
                <td>{{$value->storename}}</td>
                <td>{{$value->contact}}</td>
                <td>{{$value->mobile}}</td>
                <td class="td-status">
                    @if($value->status == 1)正常
                    @else 关闭
                    @endif
                </td>
                <td><a href="javascript:nexus0({{$value->id}});">{{$value->storeCount['nexus0']}}</a></td>
                <td><a href="javascript:nexus1({{$value->id}});">{{$value->storeCount['nexus1']}}</a></td>
                <td><a href="javascript:service({{$value->id}});">{{$value->storeCount['service']}}</a></td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    @if($value->status=='1')
                        <a style="text-decoration:none" onClick="store_stop(this,{{$value->id}})" href="javascript:;" title="关闭"><i class="Hui-iconfont">&#xe631;</i></a>
                    @else
                        <a style="text-decoration:none" onClick="store_start(this,{{$value->id}})" href="javascript:;" title="正常"><i class="Hui-iconfont">&#xe615;</i></a>
                    @endif
                    <a title="审核" href="javascript:;" onclick="store_auth('审核','/admin/store/store/auth','600','700','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>
                    <a title="资产" href="javascript:;" onclick="store_asset('商户资产','/admin/store/store/asset','300','250','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe63a;</i></a>
                    <a title="编辑" href="javascript:;" onclick="store_edit('门店编辑','/admin/store/store/update','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="门店信息" href="javascript:;" onclick="store_info('门店信息','/admin/store/store/info','500','550','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe625;</i></a>
                    <a title="美发师" href="javascript:;" onclick="store_nexus('美发师','/admin/store/store/nexus','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe60d;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 13] }],
        "order":[11,'desc'],
    });

    /*商户-资产*/
    function store_asset(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*门店-添加*/
    function store_add(title,url,w,h){
        layer_show(title,url,w,h);
    }

    /*门店-关闭*/
    function store_stop(obj,id){
        layer.confirm('确认要关闭吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/store/store/status',
                type:'post',
                dataType:'json',
                data:{'status':0, 'id':id,},
                success:function(result){
                    if (result == '1') {
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="store_start(this,id)" href="javascript:;" title="正常" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('关闭');
                        $(obj).remove();
                        layer.msg('已关闭!',{icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('关闭失败!',{icon: 5,time:1000});
                    }

                }
            });
        });
    }

    /*门店-正常*/
    function store_start(obj,id){
        layer.confirm('确认要正常吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/store/store/status',
                type:'post',
                dataType:'json',
                data:{'status':1, 'id':id,},
                success:function(result){
                    if (result == '1'){
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="store_stop(this,id)" href="javascript:;" title="关闭" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
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

    /*门店-审核*/
    function store_auth(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*门店-编辑*/
    function store_edit(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*门店-信息*/
    function store_info(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*门店-美发师*/
    function store_nexus(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    function nexus0(id) {
        var index = layer.open({
            type: 2,
            content: '/admin/store/store/nexus0?id='+id,
            title: '入驻列表'
        });
        layer.full(index);
    }

    function nexus1(id) {
        var index = layer.open({
            type: 2,
            content: '/admin/store/store/nexus1?id='+id,
            title: '签约列表'
        });
        layer.full(index);
    }

    function service(id) {
        var index = layer.open({
            type: 2,
            content: '/admin/store/store/service?id='+id,
            title: '服务列表'
        });
        layer.full(index);
    }
</script>
@endsection