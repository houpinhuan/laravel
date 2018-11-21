@extends('admin.layouts.content')

@section('content')
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="10">用户列表</th>
        </tr>
        <tr class="text-c">
            <th>编号</th>
            <th>头像</th>
            <th>账号</th>
            <th>昵称</th>
            <th>手机号码</th>
            <th>性别</th>
            <th>角色</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->id_no}}</td>
                <td><img src="{{$value->userAttach['path']}}" height="50px"></td>
                <td>{{$value->username}}</td>
                <td>{{$value->nickname}}</td>
                <td>{{$value->mobile}}</td>
                <td>
                    @if($value->gender == 1)男
                    @elseif($value->gender == 2)女
                    @else 人妖
                    @endif
                </td>
                <td>
                    @if($value->role == 1)用户
                    @elseif($value->role == 2)美发师
                    @else 商户
                    @endif
                </td>
                <td class="td-status">
                    @if($value->status == 0)正常
                    @else 禁止
                    @endif
                </td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    @if($value->status=='0')
                        <a style="text-decoration:none" onClick="user_stop(this,{{$value->id}})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                    @else
                        <a style="text-decoration:none" onClick="user_start(this,{{$value->id}})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
                    @endif
                    <a title="审核" href="javascript:;" onclick="user_auth('审核','/admin/user/user/auth','600','800','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>
                    <a title="编辑" href="javascript:;" onclick="user_edit('用户编辑','/admin/user/user/update','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="用户信息" href="javascript:;" onclick="user_info('用户信息','/admin/user/user/info','500','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe60d;</i></a>
                    <a title="提现绑定信息" href="javascript:;" onclick="user_accountBind('提现绑定信息','/admin/user/user/accountBind','1000','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6bf;</i></a>
                    @if($value->role==1)
                    <a title="套餐购买" href="javascript:;" onclick="user_package('套餐购买','/admin/user/user/package','1000','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe670;</i></a>
                    @endif
                    <a title="邀请详情" href="javascript:;" onclick="user_invite('邀请详情','/admin/user/user/invite','800','800','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6aa;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 9 ] }],
        "order": [0,'desc'],
    });
    /*用户-审核*/
    function user_auth(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
    /*用户-编辑*/
    function user_edit(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
    /*用户-停用*/
    function user_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/user/user/status',
                type:'post',
                dataType:'json',
                data:{'status':-1, 'id':id,},
                success:function(result){
                    if (result == '1') {
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="user_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('禁止');
                        $(obj).remove();
                        layer.msg('已停用!',{icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('停用失败!',{icon: 5,time:1000});
                    }

                }
            });
        });
    }
    /*用户-启用*/
    function user_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url:'/admin/user/user/status',
                type:'post',
                dataType:'json',
                data:{'status':0, 'id':id,},
                success:function(result){
                    if (result == '1'){
                        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="user_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('正常');
                        $(obj).remove();
                        layer.msg('已启用!', {icon: 6,time:1000});
                        location.href = location.href;
                    }else{
                        layer.msg('启用失败!', {icon: 5,time:1000});
                    }
                }
            });
        });
    }
    /*用户-信息*/
    function user_info(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
    /*用户-提现绑定信息*/
    function user_accountBind(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
    /*用户-套餐*/
    function user_package(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
    /*邀请-详情*/
    function user_invite(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

</script>
@endsection