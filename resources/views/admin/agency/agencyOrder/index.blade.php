@extends('admin.layouts.content')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 代理管理 <span class="c-gray en">&gt;</span> 代理订单<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="" method="get">
        <div class="text-c">
            <select class="input-text" name="status" size="1" style="width:100px">
                <option value="1" selected>申请中</option>
                <option value="9" @if($status==9) selected @endif>通过</option>
                <option value="0" @if($status==0) selected @endif>删除</option>
            </select>
            <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
        </div>
    </form>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            @if($status==1)
            <th scope="col" colspan="6">代理订单</th>
            @else
            <th scope="col" colspan="5">代理订单</th>
            @endif
        </tr>
        <tr class="text-c">
            <th>地址名称</th>
            <th>联系人</th>
            <th>手机号码</th>
            <th>创建时间</th>
            <th>状态</th>
            @if($status==1)
            <th>操作</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>{{$value->area->name}}</td>
                <td>{{$value->contact}}</td>
                <td>{{$value->mobile}}</td>
                <td>{{$value->createtime}}</td>
                <td>@if($value->status==0)删除
                    @elseif($value->status==1)申请中
                    @else通过@endif</td>
                @if($status==1)
                <td class="td-manage">
                    <a title="审核" href="javascript:;" onclick="auth('审核','/admin/agencyOrder/auth','400','300','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a></td>
                @endif
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
        "aoColumnDefs": [ { "bSortable": false}],
        "order":[3,'desc']
    });

    /*审核*/
    function auth(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }
</script>
@endsection