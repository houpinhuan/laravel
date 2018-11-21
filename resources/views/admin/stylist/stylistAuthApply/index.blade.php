@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 美发师管理 <span class="c-gray en">&gt;</span> 美发师审核 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
            <th scope="col" colspan="9">美发师审核</th>
        </tr>
        <tr class="text-c">
            <th>账号</th>
            <th>昵称</th>
            <th>真实姓名</th>
            <th>手机号码</th>
            <th>性别</th>
            <th>身份证号</th>
            <th>创建时间</th>
            <th>审核状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->stylist->user->username}}</td>
                <td>{{$value->stylist->user->nickname}}</td>
                <td>{{$value->realname}}</td>
                <td>{{$value->stylist->user->mobile}}</td>
                <td>@if($value->stylist->user->gender==1)男
                    @elseif($value->stylist->user->gender==2)女
                    @else人妖@endif</td>
                <td>{{$value->cardno}}</td>
                <td>{{$value->createtime}}</td>
                <td>@if($value->status==0)待审核
                    @else驳回@endif</td>
                <td class="td-manage">
                    <a title="审核" href="javascript:;" onclick="stylist_auth('审核','/admin/stylist/stylistAuthApply/auth','600','800','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>
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
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,8 ] }],
        "order": [6,'desc'],
    });

    /*美发师-审核*/
    function stylist_auth(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection
