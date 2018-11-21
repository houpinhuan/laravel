@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 美发师管理 <span class="c-gray en">&gt;</span> 美发师列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form method="get" action="">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" name="datemin" value="@if(!empty($datemin)){{$datemin}}@endif" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" name="datemax" value="@if(!empty($datemax)){{$datemax}}@endif" class="input-text Wdate" style="width:120px;">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜美发师</button>
    </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="12">美发师列表</th>
        </tr>
        <tr class="text-c">
            <th>美发师编号</th>
            <th>美发师账号</th>
            <th>美发师昵称</th>
            <th>手机号码</th>
            <th>性别</th>
            <th>美发师状态</th>
            <th>职位</th>
            <th>标签</th>
            <th>服务量</th>
            <th>门店运营状态</th>
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
                <td>@if($value->user->status==0)正常@else禁止@endif</td>
                <td>{{$value->position}}</td>
                <td>{{$value->label}}</td>
                <td><a href="javascript:service({{$value->id}});">{{$value->stylistCount['service']}}</a></td>
                <td class="td-status">
                    @if($value->status == 1)正常
                    @else 关闭
                    @endif
                </td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="审核" href="javascript:;" onclick="stylist_auth('审核','/admin/stylist/stylist/auth','600','800','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>
                    <a title="编辑" href="javascript:;" onclick="stylist_edit('美发师编辑','/admin/stylist/stylist/update','800','550','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a title="资产" href="javascript:;" onclick="stylist_asset('资产','/admin/stylist/stylist/asset','300','250','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe63a;</i></a>
                    <a title="时间信息" href="javascript:;" onclick="stylist_time('时间信息','/admin/stylist/stylist/time','1200','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe690;</i></a>
                    <a title="累计评价" href="javascript:;" onclick="stylist_count('累计评价','/admin/stylist/stylist/stylistCount','200','300','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe686;</i></a>
                    <a title="门店" href="javascript:;" onclick="stylist_setting('门店','/admin/stylist/stylist/setting','800','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe625;</i></a>
                    <a title="服务" href="javascript:;" onclick="stylist_service('服务','/admin/stylist/stylist/serviceInfo','1000','650','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe627;</i></a>
                    <a title="优惠券" href="javascript:;" onclick="stylist_coupon('优惠券','/admin/stylist/stylist/coupon','1700','650','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6ca;</i></a>
                    <a title="套餐券" href="javascript:;" onclick="stylist_package('套餐券','/admin/stylist/stylist/package','1000','650','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6b6;</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{--{{ $data->links()}}--}}

    {{--<a href="{{ $data->previousPageUrl() }}" class="layui-laypage-next" data-page="3">上一页</a>--}}
   {{--{{ $data->currentPage() }}--}}
    {{--<a href="{{ $data->nextPageUrl() }}" class="layui-laypage-next layui-btn-disabled" data-page="3">下一页</a>--}}

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
        "order": [8,'desc'],
    });

    /*美发师-审核*/
    function stylist_auth(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-编辑*/
    function stylist_edit(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-资产*/
    function stylist_asset(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*时间-信息*/
    function stylist_time(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*时间-信息*/
    function stylist_count(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-门店*/
    function stylist_setting(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-服务*/
    function stylist_service(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-优惠券*/
    function stylist_coupon(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    /*美发师-套餐券*/
    function stylist_package(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

    function service(id) {
        var index = layer.open({
            type: 2,
            content: '/admin/stylist/stylist/service?id='+id,
            title: '每月服务列表'
        });
        layer.full(index);
    }
</script>
@endsection