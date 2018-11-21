@extends('admin.layouts.content')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 代理管理 <span class="c-gray en">&gt;</span> 代理日志 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <form method="get" action="">
            <div class="text-c">
                <input type="text" class="input-text" name="idNo" value="@if(!empty($idNo)){{$idNo}}@endif" style="width:120px;">
                <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜代理编号</button>
            </div>
        </form>
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr>
                <th scope="col" colspan="12">代理日志</th>
            </tr>
            <tr class="text-c">
                <th>代理编号</th>
                <th>代理昵称</th>
                <th>代理手机号</th>
                <th>类型</th>
                <th>门店名称</th>
                <th>订单编号</th>
                <th>用户昵称</th>
                <th>用户手机号</th>
                <th>关联金额</th>
                <th>获取金额</th>
                <th>手续费</th>
                <th>创建时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="text-c">
                    <td>{{$value->agencyUser->id}}</td>
                    <td>{{$value->agencyUser->nickname}}</td>
                    <td>{{$value->agencyUser->mobile}}</td>
                    <td>@if($value->type==1)服务@else商城@endif</td>
                    <td>{{$value->store->storename}}</td>
                    <td>{{$value->order->orderno}}</td>
                    <td>{{$value->user->nickname}}</td>
                    <td>{{$value->user->mobile}}</td>
                    <td>{{$value->joinAmount}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->fee}}</td>
                    <td>{{$value->createtime}}</td>
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
            "aoColumnDefs": [ { "bSortable": false,}],
            "order":[11,'desc'],
        });
    </script>
@endsection