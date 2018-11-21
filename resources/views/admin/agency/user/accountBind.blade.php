@extends('admin.layouts.content')

@section('content')
    <div style="margin-left: 10px">
        <div class="page-container">
            <table class="table table-border table-bordered table-bg">
                <thead>
                <tr class="text-c">
                    <th>真实姓名</th>
                    <th>证件号码</th>
                    <th>账号类型</th>
                    <th>账号</th>
                    <th>账户附加支行信息</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr class="text-c">
                        <td>{{$value->realname}}</td>
                        <td>{{$value->idcard}}</td>
                        <td>@if($value->accounttype=='ICBC')中国工商银行
                            @elseif($value->accounttype=='ALI')支付宝
                            @else微信@endif</td>
                        <td>{{$value->accountno}}</td>
                        <td>{{$value->accountbranch}}</td>
                        <td>@if($value->status==0)已删除@else使用中@endif</td>
                        <td>{{$value->createtime}}</td>
                        <td>{{$value->updatetime}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        //实例化datatables插件
        $('.table').dataTable({
            "aoColumnDefs": [ { "bSortable": false }],
            "order" : [ 7,'desc' ],
        });
    </script>
@endsection