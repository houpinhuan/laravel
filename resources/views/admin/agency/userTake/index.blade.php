@extends('admin.layouts.content')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 代理管理 <span class="c-gray en">&gt;</span> 代理提现 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <form action="" method="get">
            <div class="text-c">
                <select class="input-text" name="status" size="1" style="width:100px">
                    <option value="1" selected>申请中</option>
                    <option value="9" @if($status==9) selected @endif>已完成</option>
                    <option value="0" @if($status==0) selected @endif>已拒绝</option>
                </select>
                <button type="submit" class="btn btn-success"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
            </div>
        </form>
        @if($status!=0)
        <div class="cl pd-5 bg-1 bk-gray mt-20"><a href="javascript:;" onclick="location.href='/admin/agency/userTake/export?status={{$status}}'" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe644;</i> 导出</a></div>
        @endif
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr>
                <th scope="col" colspan="15">代理提现</th>
            </tr>
            <tr class="text-c">
                <th>昵称</th>
                <th>真实名称</th>
                <th>手机号码</th>
                <th>证件号码</th>
                <th>账号类型</th>
                <th>账号</th>
                <th>账户附加支行信息</th>
                <th>金额</th>
                <th>手续费</th>
                <th>状态</th>
                <th>创建时间</th>
                @if($status==1)
                <th>操作</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="text-c">
                    <td>{{$value->user->nickname}}</td>
                    <td>{{$value->realname}}</td>
                    <td>{{$value->user->mobile}}</td>
                    <td>{{$value->idcard}}</td>
                    <td>{{$value->accounttype}}</td>
                    <td>{{$value->accountno}}</td>
                    <td>{{$value->accountbranch}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->fee}}</td>
                    <td>@if($value->status==0)已拒绝@elseif($value->status==1)申请中@else已完成@endif</td>
                    <td>{{$value->updatetime}}</td>
                    @if($value->status==1)
                    <td class="td-manage">
                        <a title="审核" href="javascript:;" onclick="take_auth('审核','/admin/agency/userTake/auth','500','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>
                    </td>
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
            "order" : [10,'desc'],
        });

        /*提现-申请*/
        function take_auth(title,url,w,h,id){
            layer_show(title,url+'?id='+id,w,h);
        }
    </script>
@endsection