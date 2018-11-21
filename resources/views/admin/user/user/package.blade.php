@extends('admin.layouts.content')

@section('content')
<div style="margin-left: 10px">
    <div class="page-container">
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr class="text-c">
                <th>套餐类型</th>
                <th>可使用次数</th>
                <th>原价</th>
                <th>价格</th>
                <th>美发师昵称</th>
                <th>库存次数</th>
                <th>使用次数</th>
                <th>总共次数</th>
                <th>套餐购买次数</th>
                <th>创建时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr class="text-c">
                    <td>@if($value->servicePackage->type==1)单项多次套餐@else多项单次套餐@endif</td>
                    <td>{{$value->servicePackage->times}}</td>
                    <td>{{$value->servicePackage->costprice}}</td>
                    <td>{{$value->servicePackage->price}}</td>
                    <td>{{$value->user[0]->nickname}}</td>
                    <td>{{$value->stocktimes}}</td>
                    <td>{{$value->usetimes}}</td>
                    <td>{{$value->totaltimes}}</td>
                    <td>{{$value->packagetimes}}</td>
                    <td>{{$value->createtime}}</td>
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
        "order": [9,'desc']
    });
</script>
@endsection