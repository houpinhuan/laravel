@extends('admin.layouts.content')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th>套餐类型</th>
            <th>使用次数</th>
            <th>原价</th>
            <th>价格</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr class="text-c">
                <td>@if($value->type==1)单项多次套餐
                    @else 多项单次套餐 @endif</td>
                <td>{{$value->times}}</td>
                <td>{{$value->costprice}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->createtime}}</td>
                <td class="td-manage">
                    <a title="查看内容" href="javascript:;" onclick="package_content('查看内容','/admin/stylist/stylist/packageContent','1000','600','{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe623;</i></a>
                </td>
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
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 5 ] }],
        "order": [4,'desc'],
    });

    /*套餐券—查看内容*/
    function package_content(title,url,w,h,id){
        layer_show(title,url+'?id='+id,w,h);
    }

</script>
@endsection